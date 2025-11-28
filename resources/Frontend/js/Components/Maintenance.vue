<template>
    <main class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 flex items-center justify-center p-4">
        <section
            class="w-full max-w-3xl rounded-2xl bg-white shadow-lg ring-1 ring-black/5 overflow-hidden"
            role="status"
            aria-live="polite"
        >
            <div class="px-6 py-8 md:px-10 md:py-12">
                <div class="flex items-center gap-3 mb-6">
                    <!-- Logo placeholder -->
                    <div class="h-10 w-10 rounded-xl bg-gray-100 flex items-center justify-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="h-6 w-6 text-gray-500"
                        >
                            <path
                                d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 5a1 1 0 10-2 0v5a1 1 0 00.293.707l3 3a1 1 0 101.414-1.414L13 11.586V7z"
                            />
                        </svg>
                    </div>
                    <h1 class="text-xl md:text-2xl font-semibold text-gray-900">90S House</h1>
                </div>

                <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900">Website đang cập nhật</h2>
                <p class="mt-2 text-gray-600">
                    Chúng tôi đang cải thiện trải nghiệm. Nếu cần hỗ trợ ngay, vui lòng liên hệ:
                </p>

                <dl class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            class="h-6 w-6 text-gray-500"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 6.75c0-1.243 1.007-2.25 2.25-2.25h15c1.243 0 2.25 1.007 2.25 2.25v.26a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.926A2.25 2.25 0 012.25 7.01v-.26z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 9.75l7.19 4.426a4.5 4.5 0 004.62 0L21.25 9.75M2.25 16.5h19.5"
                            />
                        </svg>
                        <div>
                            <dt class="text-sm text-gray-500">Tên doanh nghiệp</dt>
                            <dd class="font-medium text-gray-900">90s House</dd>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            class="h-6 w-6 text-gray-500"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12a3 3 0 106 0 3 3 0 00-6 0z" />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 12c0 7.142-7.5 9.75-7.5 9.75S4.5 19.142 4.5 12a7.5 7.5 0 1115 0z"
                            />
                        </svg>
                        <div class="flex-1">
                            <dt class="text-sm text-gray-500">Địa chỉ</dt>
                            <dd class="font-medium text-gray-900">
                                91/55 Đường T8, Phường Tây Thạnh, TP Hồ Chí Minh, Việt Nam
                            </dd>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            class="h-6 w-6 text-gray-500"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 3.75h19.5M4.5 6h15a2.25 2.25 0 012.25 2.25v9A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25v-9A2.25 2.25 0 014.5 6z"
                            />
                        </svg>
                        <div class="flex-1">
                            <dt class="text-sm text-gray-500">Mã số thuế (MST)</dt>
                            <dd class="font-medium text-gray-900 flex items-center gap-2">
                                <span>{{ taxCode }}</span>
                                <button
                                    type="button"
                                    @click="copy(taxCode)"
                                    class="text-xs px-2 py-1 rounded-lg border border-gray-200 hover:border-gray-300 active:scale-[.98]"
                                    :aria-label="'Sao chép MST ' + taxCode"
                                >
                                    Sao chép
                                </button>
                            </dd>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                            class="h-6 w-6 text-gray-500"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 7.5A3.75 3.75 0 016 3.75h.75c.621 0 1.173.384 1.378.969l1.154 3.186a1.5 1.5 0 01-.46 1.682l-1.2 1a16.5 16.5 0 006.75 6.75l1-1.2a1.5 1.5 0 011.682-.46l3.186 1.154c.585.205.969.757.969 1.378V18A3.75 3.75 0 0116.5 21.75h-.75C8.037 21.75 2.25 15.963 2.25 9V8.25z"
                            />
                        </svg>
                        <div>
                            <dt class="text-sm text-gray-500">Hotline</dt>
                            <dd class="font-medium text-gray-900">
                                <a
                                    :href="'tel:' + hotline"
                                    class="underline underline-offset-4 hover:no-underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 rounded"
                                    >{{ formatPhone(hotline) }}</a
                                >
                            </dd>
                        </div>
                    </div>
                </dl>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a
                        :href="'tel:' + hotline"
                        class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm font-medium bg-gray-900 text-white hover:bg-gray-800 active:scale-[.99]"
                    >
                        Gọi ngay
                    </a>
                    <button
                        type="button"
                        @click="addContact()"
                        class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm font-medium border border-gray-200 hover:border-gray-300"
                    >
                        Lưu danh bạ (vCard)
                    </button>
                </div>

                <p class="mt-6 text-xs text-gray-500">
                    © {{ new Date().getFullYear() }} 90s House. Mọi quyền được bảo lưu.
                </p>
            </div>
        </section>
    </main>
</template>

<script>
export default {
    name: 'MaintenancePage',
    data() {
        return {
            companyName: '90s House',
            taxCode: '0318965257',
            address: '91/55 Đường T8, Phường Tây Thạnh, TP Hồ Chí Minh, Việt Nam',
            hotline: '0877627657',
        }
    },
    mounted() {
        // Inject structured data for SEO (Organization)
        const data = {
            '@context': 'https://schema.org',
            '@type': 'Organization',
            name: this.companyName,
            address: {
                '@type': 'PostalAddress',
                streetAddress: '91/55 Đường T8',
                addressLocality: 'Phường Tây Thạnh',
                addressRegion: 'TP Hồ Chí Minh',
                addressCountry: 'VN',
            },
            taxID: this.taxCode,
            telephone: this.hotline,
            url: typeof window !== 'undefined' ? window.location.origin : undefined,
        }
        const script = document.createElement('script')
        script.type = 'application/ld+json'
        script.text = JSON.stringify(data)
        document.head.appendChild(script)
    },
    methods: {
        async copy(text) {
            try {
                await navigator.clipboard.writeText(text)
                this.toast('Đã sao chép!')
            } catch (_) {
                // fallback
                const area = document.createElement('textarea')
                area.value = text
                document.body.appendChild(area)
                area.select()
                document.execCommand('copy')
                document.body.removeChild(area)
                this.toast('Đã sao chép!')
            }
        },
        formatPhone(raw) {
            // simple VN spacing: 3-3-4 or 4-3-4 depending on leading 0
            const digits = (raw || '').replace(/\D/g, '')
            if (digits.length === 10) return digits.replace(/(\d{3})(\d{3})(\d{4})/, '$1 $2 $3')
            if (digits.length === 11) return digits.replace(/(\d{4})(\d{3})(\d{4})/, '$1 $2 $3')
            return raw
        },
        addContact() {
            const vcf = `BEGIN:VCARD\nVERSION:3.0\nN:;Khoi Vi Co., Ltd;;;\nFN:Công ty TNHH Khơi Vị\nORG:Công ty TNHH Khơi Vị\nTEL;TYPE=WORK,VOICE:${this.hotline}\nADR;TYPE=WORK:;;91/55 Đường T8;TP Hồ Chí Minh;;VN\nNOTE:MST ${this.taxCode}\nEND:VCARD`
            const blob = new Blob([vcf], { type: 'text/vcard' })
            const url = URL.createObjectURL(blob)
            const a = document.createElement('a')
            a.href = url
            a.download = 'Khoi-Vi.vcf'
            document.body.appendChild(a)
            a.click()
            document.body.removeChild(a)
            URL.revokeObjectURL(url)
        },
        toast(message) {
            // lightweight toast
            const el = document.createElement('div')
            el.textContent = message
            el.className =
                'fixed bottom-4 left-1/2 -translate-x-1/2 px-3 py-2 rounded-lg bg-gray-900 text-white text-sm shadow-lg'
            document.body.appendChild(el)
            setTimeout(() => {
                el.classList.add('opacity-0')
                el.classList.add('transition-opacity')
                setTimeout(() => document.body.removeChild(el), 300)
            }, 1200)
        },
    },
}
</script>

<!-- Tailwind handled globally. No component-scoped styles needed. -->
<style>
/* Optional: smooth fade for toast */
</style>
