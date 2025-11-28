<template>
    <div
        class="fixed top-0 bottom-0 right-0 z-50 overflow-hidden bg-white"
        v-show="show"
        :class="embed ? 'left-0 overflow-auto' : 'left-from-sidebar'"
    >
        <input
            type="file"
            class="hidden"
            accept="image/png, image/gif, image/jpeg, image/svg+xml, application/pdf ,image/webp"
            multiple="true"
            ref="file"
            @change="fileChange"
        />
        <div class="topbar" v-if="!embed">
            <h1 class="flex items-center font-semibold text-gray-700">
                <div
                    class="p-4 -ml-4 cursor-pointer hover:text-gray-900"
                    @click="$emit('update:show', false)"
                    v-if="selectable"
                >
                    <ph-caret-left />
                </div>
                {{ tt('models.files.file_manager') }}
            </h1>
            <div class="flex ml-auto space-x-3 items-center">
                <input
                    type="text"
                    :placeholder="tt('models.files.input_file')"
                    class="flex-inline w-[400px] py-[0.5rem] px-[1rem] border border-gray-300 focus:border-solid focus:outline-none focus:ring-0 rounded hover:border-gray-400 focus:border-gray-500"
                    @input="onChange"
                />
                <Button @click.prevent="showFolderModal = true" class="space-x-2 btn-outline-primary">
                    <ph-plus-circle-light />
                    <span> {{ tt('models.files.add_folder') }} </span>
                </Button>

                <!-- Spinner / progress indicator -->
                <div v-if="uploading" class="flex items-center space-x-3">
                    <svg
                        class="animate-spin h-5 w-5 text-gray-700"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <div class="text-sm text-gray-700">
                        Đang tải... <span v-if="globalProgress !== null">{{ globalProgress }}%</span>
                    </div>
                </div>

                <Button @click.prevent="browse" class="space-x-2 btn-primary" :disabled="uploading">
                    <ph:upload-simple />
                    <span> {{ tt('models.files.select_file') }} </span>
                </Button>
            </div>
        </div>
        <div class="flex items-stretch flex-1 h-full overflow-hidden" @dragover.prevent="isDragging = true">
            <div
                class="fixed inset-0 overflow-hidden border-4 border-dashed before:absolute before:bg-green-300 before:bg-opacity-25 before:inset-0 before:z-10 left-from-sidebar"
                :class="
                    isDragging
                        ? 'z-10 border-green-300 before:visible visible'
                        : 'z-0 border-transparent before:invisible invisible'
                "
                @dragleave.prevent="isDragging = false"
                @drop.prevent=";(isDragging = false), (dragCounter = 0), drop($event)"
            ></div>

            <!-- Details sidebar -->
            <aside class="hidden p-8 pb-16 overflow-y-auto bg-white border-l border-r border-gray-200 w-80 lg:block">
                <template v-if="embed">
                    <Button @click.prevent="browse" class="w-full space-x-2 btn-primary">
                        <ph:upload-simple />
                        <span> {{ tt('models.files.select_file') }} </span>
                    </Button>
                    <hr class="my-2" />
                </template>
                <Field
                    v-if="tree && tree.length"
                    :field="{
                        key: 'FileManager',
                        label: false,
                        type: 'tree',
                        maxLevel: 10,
                        expandDefaultLevel: 2,
                        keyBy: 'slug',
                        labelBy: 'name',
                        childrenBy: 'children',
                        options: tree,
                        draggable: false,
                    }"
                />
            </aside>
            <main
                class="overflow-y-auto grow group-image-admin"
                :class="canDeleteFolder ? 'flex items-center flex-col justify-center' : 'flex-1'"
            >
                <div v-if="canDeleteFolder">
                    <h1 v-if="canDeleteFolder" class="text-xl">
                        {{ tt('models.files.drop') }}
                        <a @click="browse" class="link">{{ tt('models.files.click_here').toLowerCase() }}</a>
                        {{ tt('models.files.select_files').toLowerCase() }}
                    </h1>
                </div>
                <div v-if="canDeleteFolder" class="mt-6">
                    <Button @click="deleteFolder" class="space-x-2 btn-outline-primary">
                        <carbon:subtract-alt />
                        <span> {{ tt('models.files.delete_folder') }} </span>
                    </Button>
                </div>
                <div
                    v-if="Object.keys(searchFiles).length"
                    class="px-4 pt-8 pb-16 mx-auto space-y-4 max-w-7xl sm:px-6 lg:px-8"
                >
                    <ul role="list" class="grid grid-cols-3 gap-4 lg:grid-cols-4 2xl:grid-cols-6">
                        <li class="relative" v-if="data" v-for="(file, index) in searchFiles" :key="file.static_url">
                            <div
                                class="group w-full rounded bg-gray-100 overflow-hidden aspect-[1/1] flex cursor-pointer justify-center items-center border border-transparent hover:border-gray-400 relative outline outline-offset-2 outline-2"
                                :class="selectedFiles.includes(file) ? 'outline-black' : 'outline-transparent'"
                                @click="onSelect(file)"
                            >
                                <Thumbnail :file="file" @remove="onRemove(file)" />
                            </div>
                            <p class="block mt-2 text-sm font-medium text-gray-900 truncate pointer-events-none">
                                {{ file.filename }}
                            </p>
                            <p class="block space-x-1 text-xs font-medium text-gray-500 pointer-events-none">
                                <span class="uppercase">
                                    {{ file.extension }}
                                </span>
                                <span>•</span>
                                <span>
                                    {{ file.formatted_file_size }}
                                </span>
                            </p>
                        </li>
                    </ul>

                    <Pagination v-if="data" :links="data.links" @changePage="getFiles($event)" />
                </div>
            </main>
        </div>
        <div
            v-if="canSelectMultiple && selectedFiles.length > 0"
            class="absolute bottom-0 left-0 right-0 flex items-center justify-center w-full h-16 space-x-2 bg-white border-t"
        >
            <Button @click="selectedFiles = []"> {{ tt('models.files.unchecked') }} </Button>
            <Button class="btn-primary" @click="submitFileSelect()">
                {{ tt('models.files.select') }} ({{ selectedFiles.length }})
            </Button>
        </div>

        <!-- Upload progress panel (fixed above bottom action bar) -->
        <div
            v-if="uploadingFiles.length && uploading"
            class="fixed left-0 right-0 bottom-16 z-50 flex flex-col items-center space-y-2 p-4 pointer-events-none"
        >
            <div class="w-full max-w-3xl space-y-2 pointer-events-auto">
                <div
                    v-for="(file, idx) in uploadingFiles"
                    :key="file.filename"
                    class="bg-white border rounded p-3 shadow-sm"
                >
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-800 truncate max-w-[70%]">
                            {{ file.filename }}
                        </div>
                        <div class="text-xs text-gray-500">
                            <span v-if="uploadProgress[file.filename] !== undefined"
                                >{{ uploadProgress[file.filename] }}%</span
                            >
                            <span v-else>0%</span>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 rounded h-2 mt-3 overflow-hidden">
                        <div
                            class="h-2 rounded bg-blue-600 transition-all duration-200"
                            :style="{ width: (uploadProgress[file.filename] || 0) + '%' }"
                        ></div>
                    </div>
                </div>
            </div>
        </div>

        <Dialog
            header="Folder"
            v-model:visible="showFolderModal"
            :breakpoints="{
                '960px': '75vw',
                '640px': '90vw',
            }"
            :style="{ width: '50vw' }"
            :draggable="false"
        >
            <Field
                v-model="folderForm.name"
                :field="{
                    rules: 'required',
                    name: 'name',
                }"
            />
            <template #footer>
                <Button variant="white" @click="showFolderModal = false" :label="tt('models.files.cancel')" />
                <Button
                    type="button"
                    class="ml-2"
                    @click="createFolder(folderForm.name), (showFolderModal = false)"
                    :label="tt('models.files.save')"
                />
            </template>
        </Dialog>
    </div>
</template>

<script>
import Pagination from '@Core/Components/Pagination.vue'
import Thumbnail from '@Core/Components/Thumbnail.vue'
import { onMounted, onUnmounted } from 'vue'

const MAX_SIZE_OF_IMAGE = 10
const MAX_SIZE_OF_VIDEO = 50

export default {
    components: { Thumbnail, Pagination },
    props: {
        show: {
            default: false,
        },
        multiple: {
            default: false,
        },
        selectable: {
            default: true,
        },
    },

    setup(props, { emit }) {
        const close = () => {
            emit('update:show', false)
        }

        const closeOnEscape = (e) => {
            if (e.key === 'Escape' && props.show) {
                close()
            }
        }

        onMounted(() => document.addEventListener('keydown', closeOnEscape))
        onUnmounted(() => {
            document.removeEventListener('keydown', closeOnEscape)
        })

        return {
            close,
        }
    },

    data() {
        return {
            uploadingFiles: [], // files currently uploading (for UI)
            selectedFiles: [],
            isDragging: false,
            timer: null,
            timerScoll: null,
            data: {
                tree: null,
                directories: [],
                files: [],
            },
            tree: null,
            currentPath: '/',
            showFolderModal: null,
            folderForm: {
                name: null,
            },
            search: null,
            embed: this.$page.props.route.query.embed,
            selectMultiple: this.$page.props.route.query['select-multiple'] == 'true',
            limit: 50,
            page: 1,
            fetchData: true,

            // upload states
            uploading: false,
            uploadProgress: {}, // filename => percent
            globalProgress: null,
        }
    },

    created() {
        this.getFiles()
    },

    mounted() {
        this.$bus.on('treeSelectedItemFileManager', (item) => {
            this.selectedItem(item)
        })

        let images = document.querySelector('.group-image-admin')

        if (images) {
            images.addEventListener('scroll', () => {
                if (this.timerScoll) {
                    clearTimeout(this.timerScoll)
                    this.timerScoll = null
                }

                if (this.fetchData) {
                    this.timerScoll = setTimeout(this.scrollImage, 300)
                }
            })
        }
    },

    unmounted() {
        let images = document.querySelector('.group-image-admin')

        if (images) {
            images.removeEventListener('scroll', this.scrollImage)
        }
    },

    beforeDestroy() {
        this.$bus.off('treeSelectedItemFileManager')
    },

    watch: {
        show(value) {
            if (value && this.data === null) {
                this.getFiles()
            }
        },
    },

    computed: {
        searchFiles() {
            if (!this.data || !this.data.files) {
                if (!this.search) {
                    this.getFiles()
                    return this.data.files
                }
                return []
            }
            if (!this.search) return this.data.files

            this.getFiles({ keyword: this.search })

            this.fetchData = false

            return this.data.files
        },
        canDeleteFolder() {
            if (!this.data) return false

            return this.data.files.length === 0 && this.data.directories.length === 0
        },
        canSelectMultiple() {
            return this.multiple || this.selectMultiple
        },
    },

    methods: {
        scrollImage() {
            this.page = this.page + 1
            this.getFiles({ page: this.page })
        },
        selectedItem(item) {
            this.currentPath = item.path
            this.data.files = []
            this.search = null
            this.getFiles()
            this.page = 1
            this.fetchData = true
        },
        getFiles(params = {}, loadTree = false) {
            if (this.fetchData) {
                this.$axios
                    .get(
                        this.route('admin.files.index', {
                            page: 1,
                            limit: this.limit,
                            search: null,
                            path: this.currentPath,
                            ...params,
                        })
                    )
                    .then((res) => {
                        let files = this.data.files
                        let new_files = res.data.files ? res.data.files : null

                        if (Array.isArray(new_files) && new_files.length == 0) {
                            this.fetchData = false
                        } else {
                            if (this.page == 1) {
                                files = new_files
                            } else {
                                files = { ...files, ...new_files }
                            }
                            this.data = {
                                tree: res.data.tree,
                                directories: res.data.directories,
                                files: files,
                            }

                            if (!this.tree || loadTree) {
                                this.tree = res.data.tree
                            }
                        }
                    })
            }
        },
        async copyUrl(file) {
            try {
                await navigator.clipboard.writeText(this.staticUrl(file.static_url))
            } catch ($e) {}
        },
        submitToParentIframe() {
            let htmlImages = ''
            this.selectedFiles.forEach((file) => {
                let src = '/static' + new URL(file.static_url).pathname
                src = src.replace('/static/static/', '/static/')
                htmlImages += `<img src="${src}">`
            })

            window.parent.postMessage({
                mceAction: 'insertContent',
                content: htmlImages,
            })
            window.parent.postMessage({
                mceAction: 'close',
            })
            return
        },

        onSelect(file) {
            if (this.embed) {
                if (this.canSelectMultiple) {
                    this.toggleFileSelect(file)
                } else {
                    this.selectedFiles = [file]
                    this.submitToParentIframe()
                }
                return
            }

            if (!this.selectable) return

            if (!this.canSelectMultiple) {
                this.selectedFiles[0] = file
                this.submitFileSelect()
            } else {
                this.toggleFileSelect(file)
            }
        },
        toggleFileSelect(file) {
            if (!this.selectedFiles.includes(file)) {
                this.selectedFiles.push(file)
            } else {
                const fileIndex = this.selectedFiles.indexOf(file)
                this.selectedFiles.splice(fileIndex, 1)
            }
        },
        submitFileSelect() {
            if (this.embed) {
                if (this.canSelectMultiple) {
                    return this.submitToParentIframe()
                }
                return
            }
            this.$emit('on-select', this.selectedFiles)
            this.selectedFiles = []
            this.$emit('update:show', false)
        },
        browse() {
            this.$refs.file.click()
        },
        drop(event) {
            this.uploadFiles(event.dataTransfer.files)
        },
        fileChange() {
            this.uploadFiles(this.$refs.file.files)
        },

        /**
         * Upload handling: validate -> build uploadingFiles list -> upload each file separately
         */
        uploadFiles(images) {
            if (!images || images.length === 0) return

            // convert FileList to Array
            const filesArray = Array.from(images)

            // validate all first
            for (const image of filesArray) {
                const fileCheck = this.fileCheck(image)
                if (!fileCheck.valid) {
                    alert(
                        this.tt('models.files.maximum_size') +
                            ' ' +
                            fileCheck.maxSize +
                            this.tt('models.files.try_again')
                    )
                    this.$refs.file.value = ''
                    return false
                }
            }

            // prepare uploadingFiles UI list
            this.uploadingFiles = filesArray.map((f) => ({
                filename: f.name,
                size: f.size,
            }))

            // clear file input
            this.$refs.file.value = ''

            // start uploading (one by one for accurate progress)
            this.uploading = true
            this.uploadProgress = {}
            this.globalProgress = 0

            // upload sequentially to avoid concurrent heavy memory usage
            const uploadSequence = async () => {
                let totalBytes = filesArray.reduce((s, f) => s + f.size, 0)
                let uploadedBytesSoFar = 0

                for (let i = 0; i < filesArray.length; i++) {
                    const file = filesArray[i]
                    try {
                        await this.uploadSingleFile(file, (progressEvent) => {
                            // progressEvent.loaded is bytes for this file
                            const p = Math.round((progressEvent.loaded * 100) / file.size)
                            this.$set
                                ? this.$set(this.uploadProgress, file.name, p)
                                : (this.uploadProgress[file.name] = p)

                            // update global progress based on bytes
                            const approxUploaded = uploadedBytesSoFar + (progressEvent.loaded || 0)
                            this.globalProgress = Math.round((approxUploaded * 100) / totalBytes)
                        })
                        uploadedBytesSoFar += file.size
                        // ensure file reached 100%
                        this.$set
                            ? this.$set(this.uploadProgress, file.name, 100)
                            : (this.uploadProgress[file.name] = 100)
                        this.globalProgress = Math.round((uploadedBytesSoFar * 100) / totalBytes)
                    } catch (err) {
                        console.error('Upload failed for', file.name, err)
                        // mark error as 0 or special value
                        this.$set ? this.$set(this.uploadProgress, file.name, 0) : (this.uploadProgress[file.name] = 0)
                        // optionally show a message
                        alert(this.tt('models.files.upload_failed') || `Upload failed: ${file.name}`)
                    }
                }

                // finalize
                setTimeout(() => {
                    this.uploading = false
                    this.uploadingFiles = []
                    this.uploadProgress = {}
                    this.globalProgress = null
                    // refresh list after uploads
                    this.getFiles()
                }, 600)
            }

            uploadSequence()
        },

        /**
         * Upload a single file via axios with progress callback
         * returns Promise
         */
        uploadSingleFile(file, onProgress) {
            const formData = new FormData()
            formData.append('files[0]', file)
            formData.append('path', this.currentPath)

            return new Promise((resolve, reject) => {
                this.$axios
                    .post(this.route('admin.files.store'), formData, {
                        headers: { 'Content-Type': 'multipart/form-data' },
                        onUploadProgress: onProgress,
                    })
                    .then((res) => {
                        if (res.status === 200) {
                            resolve(res)
                        } else {
                            reject(res)
                        }
                    })
                    .catch((err) => {
                        reject(err)
                    })
            })
        },

        onRemove(file) {
            this.$axios
                .post(this.route('admin.files.destroy', { id: 0 }), {
                    files: [file],
                })
                .then((response) => {
                    if (response.status === 200) {
                        this.getFiles()
                    }
                })
        },
        fileCheck(file) {
            const maxSize = this.isImage(file.name) ? MAX_SIZE_OF_IMAGE : MAX_SIZE_OF_VIDEO
            const fileSize = file.size / 1024 / 1024

            return { valid: fileSize <= maxSize, maxSize }
        },
        onChange(event) {
            if (this.timer) {
                clearTimeout(this.timer)
                this.timer = null
            }

            this.timer = setTimeout(() => {
                this.search = event.target.value
                this.page = 1
                this.fetchData = true
            }, 500)
        },
        createFolder(name) {
            this.$axios
                .post(this.route('admin.files.folders.create'), {
                    name: name,
                    path: this.currentPath,
                })
                .then((res) => {
                    this.getFiles({}, true)
                    this.folderForm.name = null
                })
        },
        deleteFolder() {
            if (confirm(this.tt('models.files.confirm_delete')) == true) {
                this.$axios
                    .post(
                        this.route('admin.files.folders.delete', {
                            path: this.currentPath,
                        })
                    )
                    .then((res) => {
                        this.currentPath = '/'
                        this.getFiles({}, true)
                    })
            }
        },
    },
}
</script>

<style lang="scss" scoped>
.left-from-sidebar {
    left: var(--sidebar-width);
}
.topbar {
    @apply absolute flex items-center flex-shrink-0 w-full px-4 bg-white border-b sm:px-10 md:px-12;
    height: var(--topbar-height);
}

.topbar + div {
    @apply fixed right-0;
    top: var(--topbar-height);
    height: calc(100% - var(--topbar-height));
    left: var(--sidebar-width);
}
</style>
