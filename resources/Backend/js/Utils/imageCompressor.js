const DEFAULT_OPTIONS = {
    targetBytes: 300 * 1024, // 300KB
    maxDimension: 3000,
    initialQuality: 0.88,
    minQuality: 0.2,
    qualityStep: 0.1,
    downscaleFactor: 0.85,
    maxDownscaleSteps: 5,
    minDimension: 400,
}

const SKIP_MIME_TYPES = new Set([
    'image/svg+xml',
    'image/gif',
    'application/pdf',
])

const SKIP_EXTENSIONS = new Set([
    'svg',
    'gif',
    'pdf',
    'mp4',
    'webm',
    'mov',
    'avi',
    'ico',
])

const CONVERTIBLE_MIME_TYPES = new Set([
    'image/png',
    'image/jpeg',
    'image/jpg',
    'image/bmp',
    'image/webp',
])

const CONVERTIBLE_EXTENSIONS = new Set([
    'png',
    'jpg',
    'jpeg',
    'bmp',
    'webp',
])

/**
 * Đổi tên file sang đuôi .webp
 * @param {string} fileName
 * @returns {string}
 */
export function toWebpFileName(fileName = 'image') {
    const cleanName = String(fileName || 'image').trim() || 'image'
    const lastDotIndex = cleanName.lastIndexOf('.')
    if (lastDotIndex <= 0) {
        return `${cleanName}.webp`
    }
    return `${cleanName.slice(0, lastDotIndex)}.webp`
}

/**
 * Kiểm tra xem file có phải ảnh raster cần nén sang WebP hay không
 * @param {File|Blob} file
 * @returns {boolean}
 */
export function isConvertibleRasterImage(file) {
    if (!file || typeof Blob === 'undefined' || !(file instanceof Blob)) {
        return false
    }

    const mime = String(file.type || '').toLowerCase().trim()
    const fileName = String(file.name || '').toLowerCase().trim()
    const ext = fileName.includes('.') ? fileName.split('.').pop() : ''

    if (SKIP_MIME_TYPES.has(mime) || SKIP_EXTENSIONS.has(ext)) {
        return false
    }

    if (mime) {
        if (!mime.startsWith('image/')) {
            return false
        }
        return CONVERTIBLE_MIME_TYPES.has(mime)
    }

    return CONVERTIBLE_EXTENSIONS.has(ext)
}

function markAsCompressed(file) {
    if (file && typeof file === 'object') {
        try {
            Object.defineProperty(file, '__compressedToWebp', {
                value: true,
                enumerable: false,
                configurable: true,
            })
        } catch (_e) {
            file.__compressedToWebp = true
        }
    }
    return file
}

function loadImageFromBlob(blob) {
    return new Promise((resolve, reject) => {
        const objectUrl = URL.createObjectURL(blob)
        const img = new Image()

        img.onload = () => {
            URL.revokeObjectURL(objectUrl)
            resolve(img)
        }

        img.onerror = (err) => {
            URL.revokeObjectURL(objectUrl)
            reject(err || new Error('Failed to load image for WebP compression'))
        }

        img.src = objectUrl
    })
}

function canvasToBlob(canvas, type, quality) {
    return new Promise((resolve) => {
        try {
            canvas.toBlob(
                (blob) => {
                    resolve(blob || null)
                },
                type,
                quality
            )
        } catch (_err) {
            resolve(null)
        }
    })
}

/**
 * Nén và chuyển đổi ảnh (PNG/JPG/JPEG/BMP/WebP lớn) sang WebP ở phía Client trước khi upload
 * @param {File|Blob} file
 * @param {Object} options
 * @returns {Promise<File|Blob>}
 */
export async function compressImageToWebp(file, options = {}) {
    if (typeof window === 'undefined' || typeof document === 'undefined') {
        return file
    }

    if (!file || typeof Blob === 'undefined' || !(file instanceof Blob)) {
        return file
    }

    const config = { ...DEFAULT_OPTIONS, ...options }
    const {
        targetBytes,
        maxDimension,
        initialQuality,
        minQuality,
        qualityStep,
        downscaleFactor,
        maxDownscaleSteps,
        minDimension,
    } = config

    if (!isConvertibleRasterImage(file)) {
        return file
    }

    const fileName = String(file.name || '')
    const isAlreadyWebpName = fileName.toLowerCase().endsWith('.webp')

    if (
        file.__compressedToWebp === true ||
        (file.type === 'image/webp' && file.size <= targetBytes && isAlreadyWebpName)
    ) {
        return markAsCompressed(file)
    }

    try {
        const img = await loadImageFromBlob(file)
        let width = img.naturalWidth || img.width
        let height = img.naturalHeight || img.height

        if (!width || !height) {
            return file
        }

        if (width > maxDimension || height > maxDimension) {
            const ratio = Math.min(maxDimension / width, maxDimension / height)
            width = Math.max(1, Math.round(width * ratio))
            height = Math.max(1, Math.round(height * ratio))
        }

        const canvas = document.createElement('canvas')
        canvas.width = width
        canvas.height = height

        const ctx = canvas.getContext('2d')
        if (!ctx) {
            return file
        }

        ctx.clearRect(0, 0, width, height)
        ctx.drawImage(img, 0, 0, width, height)

        let quality = initialQuality
        let blob = await canvasToBlob(canvas, 'image/webp', quality)

        if (!blob) {
            return file
        }

        while (blob && blob.size > targetBytes && quality > minQuality) {
            quality = Math.max(minQuality, Number((quality - qualityStep).toFixed(2)))
            const nextBlob = await canvasToBlob(canvas, 'image/webp', quality)
            if (!nextBlob) {
                break
            }
            blob = nextBlob
        }

        let downscaleCount = 0
        while (
            blob &&
            blob.size > targetBytes &&
            downscaleCount < maxDownscaleSteps &&
            (width > minDimension || height > minDimension)
        ) {
            downscaleCount++
            const nextWidth = Math.max(Math.min(width, minDimension), Math.round(width * downscaleFactor))
            const nextHeight = Math.max(Math.min(height, minDimension), Math.round(height * downscaleFactor))

            if (nextWidth === width && nextHeight === height) {
                break
            }

            width = nextWidth
            height = nextHeight
            canvas.width = width
            canvas.height = height
            ctx.clearRect(0, 0, width, height)
            ctx.drawImage(img, 0, 0, width, height)

            const nextBlob = await canvasToBlob(canvas, 'image/webp', minQuality)
            if (!nextBlob) {
                break
            }
            blob = nextBlob
        }

        const webpFileName = toWebpFileName(file.name || 'image.png')
        const webpFile = new File([blob], webpFileName, {
            type: 'image/webp',
            lastModified: Date.now(),
        })

        return markAsCompressed(webpFile)
    } catch (error) {
        console.warn('[imageCompressor] Fallback to original file due to compression error:', error)
        return file
    }
}

/**
 * Duyệt qua toàn bộ entry của FormData và nén các file ảnh sang WebP
 * @param {FormData} formData
 * @param {Object} options
 * @returns {Promise<FormData>}
 */
export async function compressFormDataImages(formData, options = {}) {
    if (typeof FormData === 'undefined' || !(formData instanceof FormData)) {
        return formData
    }

    const entries = Array.from(formData.entries())
    const hasConvertibleEntry = entries.some(([, value]) => isConvertibleRasterImage(value) && !value.__compressedToWebp)

    if (!hasConvertibleEntry) {
        return formData
    }

    let modified = false
    const processedEntries = []

    for (const [key, value] of entries) {
        if (isConvertibleRasterImage(value)) {
            const compressed = await compressImageToWebp(value, options)
            if (compressed !== value) {
                modified = true
            }
            processedEntries.push([key, compressed])
        } else {
            processedEntries.push([key, value])
        }
    }

    if (!modified) {
        return formData
    }

    const keys = new Set(entries.map(([key]) => key))
    keys.forEach((key) => formData.delete(key))

    for (const [key, value] of processedEntries) {
        if (typeof File !== 'undefined' && value instanceof File) {
            formData.append(key, value, value.name)
        } else {
            formData.append(key, value)
        }
    }

    return formData
}

export default {
    compressImageToWebp,
    compressFormDataImages,
    toWebpFileName,
    isConvertibleRasterImage,
}
