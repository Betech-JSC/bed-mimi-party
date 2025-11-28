<template>
    <main class="bg-black">
        <section class="relative py-12">
            <div class="absolute inset-0">
                <JPicture
                    src="/assets/images/event/bg-event.jpg"
                    alt="background event"
                    class="w-full h-full object-cover"
                />
            </div>
            <SectionPromotionSlider :items="promotions_featured" />
        </section>
        <section class="md:pt-12 pt-8 xl:pt-[60px] pb-12 md:pb-16 xl:pb-20">
            <div class="container">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 xl:gap-6 lg:px-16 xl:px-[100px]">
                    <div v-for="(itemEvent, indexEvent) in promotions" :key="indexEvent">
                        <CardPromotion :item="itemEvent" />
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
import CardPromotion from '@/Components/Card/CardPromotion.vue'
import CardPromotionDetail from '@/Components/Card/CardPromotionDetail.vue'

export default {
    components: { CardPromotion, CardPromotionDetail },

    props: ['categories', 'posts', 'banner', 'promotions_featured', 'promotions'],
    data() {
        return {
            bannerBlog: {
                title: this.tt('Góc Nhìn Từ Sip N Source'),
                description: this.tt('Chia sẻ kiến thức, kinh nghiệm và cảm hứng từ những chiến dịch'),
                image: '/assets/images/posts/bg-banner.webp',
                breadcrumbs: [
                    {
                        title: this.tt('Bài viết'),
                    },
                ],
            },
            events: [
                {
                    image: '/assets/images/demo/image-event-1.jpg',
                    title: 'Promotion party',
                    created_at: '20.8.2025',
                    time: '20pm',
                    date: 'Sunday',
                },
                {
                    image: '/assets/images/demo/image-event-2.jpg',
                    title: 'Listening party',
                    created_at: '24.4.2025',
                    time: '20pm',
                    date: 'Sunday',
                },
                {
                    image: '/assets/images/demo/image-event-3.jpg',
                    title: 'Listening party',
                    created_at: '10.4.2025',
                    time: '20pm',
                    date: 'Sunday',
                },
                {
                    image: '/assets/images/demo/image-event-4.jpg',
                    title: 'Listening party',
                    created_at: '20.8.2025',
                    time: '20pm',
                    date: 'Sunday',
                },
                {
                    image: '/assets/images/demo/image-event-1.jpg',
                    title: 'Promotion party',
                    created_at: '20.8.2025',
                    time: '20pm',
                    date: 'Sunday',
                },
                {
                    image: '/assets/images/demo/image-event-2.jpg',
                    title: 'Listening party',
                    created_at: '24.4.2025',
                    time: '20pm',
                    date: 'Sunday',
                },
                {
                    image: '/assets/images/demo/image-event-3.jpg',
                    title: 'Listening party',
                    created_at: '10.4.2025',
                    time: '20pm',
                    date: 'Sunday',
                },
                {
                    image: '/assets/images/demo/image-event-4.jpg',
                    title: 'Listening party',
                    created_at: '20.8.2025',
                    time: '20pm',
                    date: 'Sunday',
                },
            ],
        }
    },
}
</script>
