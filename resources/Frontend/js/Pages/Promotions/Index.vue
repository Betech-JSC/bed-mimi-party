<template>
    <main class="bg-primary-900">
        <BannerImage :banner="banner" classBanner="h-[574px]" />
        <section class="py-[60px]">
            <div class="container space-y-10">
                <h2 class="title-linear display-2 uppercase font-extrabold text-center">Dự án</h2>
                <div class="grid grid-cols-2">
                    <div
                        v-for="index in 4"
                        :key="index"
                        class="border-b-8 border-primary-500 relative aspect-w-2 aspect-h-1 cursor-pointer"
                        @click="openModal(index)"
                    >
                        <div class="absolute inset-0 w-full h-full">
                            <JPicture
                                src="/assets/images/projects/bg-banner.jpg"
                                class="w-full h-full object-cover"
                                alt="Product image"
                            />
                        </div>
                        <div class="bg-overlay absolute inset-0"></div>
                        <div class="absolute top-1/2 -translate-y-1/2 h-auto px-8 max-w-[280px] w-full space-y-4 text-white">
                            <h3 class="title-2 uppercase font-bold">
                                BRAND OPENING - TRẢI NGHIỆM TIỆC TRÀ LỚN NHẤT TPHCM
                            </h3>
                            <div class="body-1">Client: Britea - English Tea House</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div v-if="isModalOpen" class="fixed inset-0 bg-[#000E27] bg-opacity-[63%] flex items-center justify-center z-[9999] p-5" @click.self="closeModal">
            <div
                class="relative max-w-[90vw] w-full max-h-[90vh] flex flex-col border border-white/20 bg-linear-modal p-8"
            >
                <button
                    class="absolute -top-14 -right-4 w-10 h-10 rounded-lg bg-white lg:hover:bg-primary-500 lg:hover:text-white duration-300 ease-in-out text-black flex items-center justify-center"
                    @click="closeModal"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-7">
                        <div class="modal-body">
                            <ThumbnailModal :product="selectedItem"  />
                        </div>
                    </div>
                    <div class="col-span-5 space-y-8">
                            <h3 class="title-linear display-3 uppercase font-extrabold">{{ selectedItem.title }}</h3>
                            <p class="body-2 text-white">{{ selectedItem.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
export default {
    components: {},

    // props: ['categories', 'posts', 'banner', 'promotions_featured', 'promotions'],
    data() {
        return {
            banner: {
                image: '/assets/images/projects/bg-banner.jpg',
            },
            isModalOpen: false,
            selectedItem: null,
            lightboxIndex: null,
            lightboxImages: [],
            currentItemIndex: null,
            currentImageIndex: {},
        }
    },
    methods: {
        openModal(index) {
            this.selectedItem = this.items[index]
            this.isModalOpen = true
            document.body.style.overflow = 'hidden'
        },
        closeModal() {
            this.isModalOpen = false
            this.selectedItem = null
            document.body.style.overflow = ''
        },
        setCurrentImage(itemIndex, imageIndex) {
            this.$set(this.currentImageIndex, itemIndex, imageIndex)
        },
        openLightbox(itemIndex, imageIndex) {
            console.log('Opening lightbox:', itemIndex, imageIndex)
            this.currentItemIndex = itemIndex
            this.lightboxImages = this.items[itemIndex].images
            this.lightboxIndex = imageIndex
        },
        onLightboxChange(newIndex) {
            console.log('Lightbox index changed:', newIndex)
            this.lightboxIndex = newIndex
        },
        closeLightbox() {
            console.log('Closing lightbox')
            this.lightboxIndex = null
            this.lightboxImages = []
            this.currentItemIndex = null
        },
    },
    beforeDestroy() {
        document.body.style.overflow = ''
    },    
}
</script>
<style lang="scss" scoped>
.bg-overlay {
    background: linear-gradient(
        270deg,
        rgba(1, 26, 63, 0) 40.69%,
        rgba(1, 31, 73, 0.88) 63.65%,
        #04214b 71.38%,
        #071e3f 75.49%,
        #040f1e 100%
    );
}
.bg-linear-modal {
    background: linear-gradient(180deg, rgba(189, 189, 189, 0.3) 0%, rgba(52, 51, 51, 0.3) 100%);
}
</style>
