<template>
    <main class="bg-primary-900">
        <BannerImage :banner="banner" classBanner="h-[574px]" />
        <SectionService :services="services" />
        <section class="md:mt-[80px] mt-[56px] xl:mt-[120px] md:py-16 py-12 xl:py-20">
            <div class="container">
                <div
                    v-for="(item, index) in items"
                    :key="index"
                    class="card-service grid grid-cols-12 gap-6 border border-white/50"
                >
                    <div class="col-span-full xl:col-span-4 w-full space-y-8">
                        <h2 class="title-linear display-3 uppercase font-extrabold">{{ item.title }}</h2>
                        <button class="btn btn-primary" @click="openModal(index)">Xem thêm</button>
                    </div>
                    <div class="col-span-full xl:col-span-8">
                        <Thumbnails :product="item" />
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
import SectionService from '@/Components/SectionService.vue'
import Thumbnails from '@/Components/Service/Thumbnails.vue'
import ThumbnailModal from '@/Components/ThumbnailModal.vue'

export default {
    components: { SectionService, Thumbnails, ThumbnailModal },
    props: ["services"],
    data() {
        return {
            banner: {
                image: '/assets/images/services/bg-banner.jpg',
            },
            items: [
                {
                    title: 'Decor trang trí bong bóng nghệ thuật',
                    description:
                        'Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo.',
                    images: [
                        {
                            url: '/assets/images/services/bg-banner.jpg',
                        },
                        {
                            url: '/assets/images/demo/image-service-1.jpg',
                        },
                        {
                            url: '/assets/images/demo/image-service-2.jpg',
                        },
                        {
                            url: '/assets/images/demo/image-service-3.jpg',
                        },
                        {
                            url: '/assets/images/services/bg-banner.jpg',
                        },
                        {
                            url: '/assets/images/demo/image-service-1.jpg',
                        },
                        {
                            url: '/assets/images/demo/image-service-2.jpg',
                        },
                    ],
                },
            ],
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
/* Hide scrollbar for thumbnails */
.overflow-x-auto::-webkit-scrollbar {
    height: 4px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}

.card-service {
    background: linear-gradient(180deg, rgba(189, 189, 189, 0.3) 0%, rgba(52, 51, 51, 0.3) 100%);
    @apply relative md:p-6 p-4 xl:p-8;
}

.bg-linear-modal {
    background: linear-gradient(180deg, rgba(189, 189, 189, 0.3) 0%, rgba(52, 51, 51, 0.3) 100%);
}

</style>
