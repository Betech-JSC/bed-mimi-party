<template>
        <section class="py-[60px] space-y-10">
            <div class="container">
                <h2 class="title-linear display-2 uppercase font-extrabold text-center">Dịch vụ</h2>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <CardService v-for="(itemService, indexService) in services" :key="indexService" :item="itemService" />
            </div>

            <div class="flex items-center justify-center">
                <button class="btn btn-primary">dịch vụ của chúng tôi</button>
            </div>
        </section>
</template>
<script>
import CardService from '@/Components/Card/CardService.vue'

export default {
    components: { CardService },
    props: ['services'],
    data() {
        return {
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
