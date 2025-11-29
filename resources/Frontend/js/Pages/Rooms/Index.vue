<template>
    <main class="bg-primary-900">
        <BannerImage :banner="banner" classBanner="h-[574px]" />
        <SectionService :services="services" />
        <section class="mt-[120px] py-20">
            <div class="container">
                <div v-for="(item, index) in items" :key="index" class="card-service grid grid-cols-12 gap-6">                    
                    <div class="col-span-4 w-full space-y-8">
                         <h2 class="title-linear display-3 uppercase font-extrabold">{{ item.title }}</h2>
                         <button class="btn btn-primary">
                            Xem thêm
                         </button>
                    </div>
                    <div class="col-span-8">
                        <Thumbnails :product="item" />
                    </div>
                </div>
            </div>
        </section>

        <!-- LightBox Component -->
        <!-- <LightBox :images="lightboxImages" :index="lightboxIndex" @change="onLightboxChange" @close="closeLightbox" /> -->
    </main>
</template>

<script>
import SectionService from '@/Components/SectionService.vue'
import Thumbnails from '@/Components/Service/Thumbnails.vue'

export default {
    components: { SectionService, Thumbnails },
    // props: ['services', 'banner'],
    data() {
        return {
            banner: {
                image: '/assets/images/services/bg-banner.jpg',
            },
            services: [
                {
                    image: {
                        url: '/assets/images/demo/image-service-1.jpg',
                        alt: 'image service 1',
                    },
                    title: 'Decor trang trí bong bóng nghệ thuật',
                    slug: 'demo-1',
                },
                {
                    image: {
                        url: '/assets/images/demo/image-service-2.jpg',
                        alt: 'image service 2',
                    },
                    title: 'Decor Tiệc theo yêu cầu',
                    slug: 'demo-2',
                },
                {
                    image: {
                        url: '/assets/images/demo/image-service-3.jpg',
                        alt: 'image service 3',
                    },
                    title: 'Decor quán mùa lễ',
                    slug: 'demo-3',
                },
            ],
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
            lightboxIndex: null,
            lightboxImages: [],
            currentItemIndex: null,
            currentImageIndex: {}, // Track current image for each item
        }
    },
    methods: {
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
    @apply relative p-8;
}
</style>
