<template>
    <section class="py-12 xl:py-[60px]">
        <div class="container space-y-6">
            <h2 class="title-linear display-2 uppercase font-extrabold md:text-right">Khách hàng tiêu biểu</h2>
            <div class="h-[300px] overflow-y-auto partner-scroll">
                <div class="grid grid-cols-3 md:grid-cols-4 xl:grid-cols-6 gap-y-3 gap-x-3 md:gap-x-6 xl:gap-x-8">
                    <div
                        v-for="(itemPartner, indexPartner) in displayPartners"
                        :key="indexPartner"
                        class="flex items-center justify-center min-h-[100px] grayscale lg:hover:grayscale-0 duration-300 ease-in-out"
                        :style="{ minHeight: `${logoBoxHeight}px` }"
                    >
                        <a
                            v-if="itemPartner?.link"
                            :href="itemPartner.link"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-auto block max-w-full"
                            :style="{ height: `${logoHeight}px` }"
                        >
                            <JPicture
                                :src="getPartnerImage(itemPartner)"
                                :alt="itemPartner?.image?.alt || itemPartner?.title || 'image partner'"
                                class="w-full h-full object-contain"
                                @error="onImageError"
                            />
                        </a>
                        <div v-else class="w-auto block max-w-full" :style="{ height: `${logoHeight}px` }">
                            <JPicture
                                :src="getPartnerImage(itemPartner)"
                                :alt="itemPartner?.image?.alt || itemPartner?.title || 'image partner'"
                                class="w-full h-full object-contain"
                                @error="onImageError"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
const DEFAULT_LOGO_HEIGHT = 72
const MIN_LOGO_HEIGHT = 24
const MAX_LOGO_HEIGHT = 200

export default {
    props: ['partners'],
    data() {
        return {
            defaultPartners: [
                '/assets/images/demo/image-partner-1.png',
                '/assets/images/demo/image-partner-2.png',
                '/assets/images/demo/image-partner-3.png',
                '/assets/images/demo/image-partner-4.png',
                '/assets/images/demo/image-partner-5.png',
                '/assets/images/demo/image-partner-6.png',
                '/assets/images/demo/image-partner-7.png',
                '/assets/images/demo/image-partner-8.png',
                '/assets/images/demo/image-partner-9.png',
                '/assets/images/demo/image-partner-10.png',
                '/assets/images/demo/image-partner-11.png',
                '/assets/images/demo/image-partner-12.png',
            ],
        }
    },
    computed: {
        displayPartners() {
            if (this.partners && this.partners.length > 0) {
                return this.partners
            }
            return this.defaultPartners
        },
        /**
         * Chiều cao logo lấy từ CMS: Settings > General > "Chiều cao logo khách hàng tiêu biểu".
         * Trước đây bị hardcode class h-10 (40px) nên không thể chỉnh trong CMS.
         */
        logoHeight() {
            const raw = this.$page?.props?.global?.partner_logo_height
            const value = parseInt(raw, 10)

            if (!Number.isFinite(value) || value <= 0) {
                return DEFAULT_LOGO_HEIGHT
            }

            return Math.min(Math.max(value, MIN_LOGO_HEIGHT), MAX_LOGO_HEIGHT)
        },
        logoBoxHeight() {
            // giữ nguyên chiều cao tối thiểu cũ của mỗi ô (100px) để không làm vỡ layout
            return Math.max(this.logoHeight + 32, 100)
        },
    },
    methods: {
        getPartnerImage(partner) {
            if (!partner) return ''
            if (typeof partner === 'string') return partner
            if (typeof partner.image === 'string') return partner.image
            return partner.image?.url || partner.image?.path || ''
        },
        onImageError(event) {
            // Tránh hiện icon ảnh vỡ nếu file logo không còn tồn tại
            if (event?.target) {
                event.target.style.visibility = 'hidden'
            }
        },
    },
}
</script>

<style lang="scss" scoped>
/* width */
.partner-scroll::-webkit-scrollbar {
    @apply w-2;
}

/* Track */
.partner-scroll::-webkit-scrollbar-track {
    @apply bg-transparent;
}

/* Handle */
.partner-scroll::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #98cdff 0%, #558dfc 100%);
    border-radius: 10px;
}
</style>
