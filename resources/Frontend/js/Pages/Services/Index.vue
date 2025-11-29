<template>
    <main class="bg-black">
        <BannerImage :banner="banner" classBanner="h-[574px]" />
        <SectionService :services="services" />
    </main>
</template>
<script>
import SectionService from '@/Components/SectionService.vue'
export default {
  components: { SectionService },
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
        }
    },
}
</script>
