<template>
    <main class="bg-black">
        <!-- Promotion Detail -->
        <section class="relative py-12">
            <div class="absolute inset-0">
                <JPicture
                    src="/assets/images/event/bg-event.jpg"
                    alt="background event"
                    class="w-full h-full object-cover"
                />
            </div>
            <div class="relative">
                <div class="container">
                    <div class="md:flex-row flex-col flex md:items-start gap-6 md:gap-8 xl:gap-14">
                        <div
                            class="max-w-full md:max-w-[300px] lg:max-w-[320px] xl:max-w-[386px] w-full maxx-md:mx-auto"
                        >
                            <CardPromotionDetail :item="eventDetail" />
                        </div>
                        <div class="flex-1 text-white md:space-y-6 space-y-4 xl:space-y-8">
                            <div class="space-y-2.5">
                                <div class="headline-2 uppercase tracking-[-0.02em]">{{ eventDetail.content }}</div>
                                <div class="title-2 flex items-center gap-4 xl:gap-6">
                                    <div class="flex items-center gap-2">
                                        <div>{{ eventDetail.time }}</div>
                                        <div>{{ eventDetail.date }}</div>
                                    </div>
                                    <div>{{ eventDetail.created_at }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-[26px]">
                                <Link :href="route('contact')">
                                    <Button> Book now </Button>
                                </Link>
                                <ButtonLink>Call us</ButtonLink>
                            </div>
                            <div class="body-2 max-w-[718px] w-full">{{ eventDetail.description }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="md:py-16 py-12 xl:py-20 relative overflow-hidden">
            <div class="circle-orange right-[-257px] top-[-190px]"></div>
            <div class="circle-orange left-[-218px] bottom-[-320px]"></div>
            <div class="relative">
                <div class="container md:space-y-6 space-y-4 xl:space-y-8">
                    <h2 class="text-white text-center">
                        <span class="display-1">The</span> <span class="display-2"> Vibes</span>
                    </h2>
                    <div
                        class="flex flex-wrap items-center justify-center gap-x-4 xl:gap-x-6 md:gap-y-6 gap-y-4 xl:gap-y-8"
                    >
                        <div
                            class="relative h-[340px] xl:h-[485px] w-auto"
                            v-for="(itemThumbnail, indexThumbnail) in eventDetail.images.slice(0, 3)"
                            :key="indexThumbnail"
                        >
                            <JPicture :src="itemThumbnail" alt="background event" class="w-full h-full object-cover" />
                        </div>
                        <div
                            class="relative h-[265px] xl:h-[375px] w-auto"
                            v-for="(itemThumbnail, indexThumbnail) in eventDetail.images.slice(3)"
                            :key="indexThumbnail"
                        >
                            <JPicture :src="itemThumbnail" alt="background event" class="w-full h-full object-cover" />
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-[26px]">
                        <Link :href="route('contact')">
                            <Button> Book now </Button>
                        </Link>
                        <ButtonLink>Call us</ButtonLink>
                    </div>
                </div>
            </div>
        </section>

        <!-- Promotion Master -->
        <section class="relative py-12">
            <div class="absolute inset-0">
                <JPicture
                    src="/assets/images/event/bg-event.jpg"
                    alt="background event"
                    class="w-full h-full object-cover"
                />
            </div>
            <SectionPromotionSlider :items="events" />
        </section>
        <section class="md:pt-12 pt-8 xl:pt-[60px] pb-12 md:pb-16 xl:pb-20">
            <div class="container">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 xl:gap-6 lg:px-16 xl:px-[100px]">
                    <div v-for="(itemEvent, indexEvent) in events" :key="indexEvent">
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

    props: ['categories', 'posts', 'banner'],
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
            eventDetail: {
                image: '/assets/images/demo/image-event-1.jpg',
                title: 'Promotion party',
                created_at: '20.8.2025',
                time: '20pm',
                date: 'Sunday',
                content: 'promotion: miễn chi phí phòng (2 giờ)',
                description:
                    '90’s House giới thiệu ưu đãi đặc biệt: Miễn phí phòng 2 giờ tại Private Lounge. Thưởng thức không gian sang trọng cùng DJ cá tính, MC chuyên nghiệp, vũ công quyến rũ và các tiết mục cuốn hút. Khách được chào đón với Welcome Drink mát lạnh, kèm Canape tinh tế để khởi đầu buổi tiệc.',
                images: [
                    '/assets/images/demo/image-promotion-1.jpg',
                    '/assets/images/demo/image-promotion-2.jpg',
                    '/assets/images/demo/image-promotion-3.jpg',
                    '/assets/images/demo/image-promotion-4.jpg',
                    '/assets/images/demo/image-promotion-5.jpg',
                    '/assets/images/demo/image-promotion-6.jpg',
                ],
            },
        }
    },
}
</script>
