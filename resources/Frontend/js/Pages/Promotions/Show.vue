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
            <div class="relative">
                <div class="container">
                    <div class="md:flex-row flex-col flex md:items-start gap-6 md:gap-8 xl:gap-14">
                        <div
                            class="max-w-full md:max-w-[300px] lg:max-w-[320px] xl:max-w-[386px] w-full maxx-md:mx-auto"
                        >
                            <CardPromotionDetail :item="promotion" />
                        </div>
                        <div class="flex-1 text-white md:space-y-6 space-y-4 xl:space-y-8">
                            <div class="space-y-2.5">
                                <div class="headline-2 uppercase tracking-[-0.02em]">{{ promotion.title }}</div>
                                <div class="title-2 flex items-center gap-4 xl:gap-6">
                                    <div class="flex items-center gap-2">
                                        <div v-if="promotion.time">{{ formatTime(promotion.time) }}</div>
                                        <div>{{ getDayOfWeek(promotion.published_at) }}</div>
                                    </div>
                                    <div>{{ formatDate(promotion.published_at) }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-[26px]">
                                <Link :href="route('contact')" class="cursor-pointer block">
                                    <Button> {{ tt('Book now') }} </Button>
                                </Link>
                                <a href="tel:090 678 35 78" class="cursor-pointer block">
                                    <ButtonLink>{{ tt('Call us') }}</ButtonLink>
                                </a>
                            </div>
                            <div class="body-2 max-w-[718px] w-full space-y-[1rem]">
                                <div class="text-white">{{ promotion.description }}</div>
                                <div class="prose" v-html="promotion.content"></div>
                            </div>
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
                    <TextAnimation className="text-center" :textFirst="tt('The ')" :textSecond="tt('Vibes')" />
                    <div
                        class="flex flex-wrap items-center justify-center gap-x-4 xl:gap-x-6 md:gap-y-6 gap-y-4 xl:gap-y-8"
                    >
                        <div
                            class="relative h-[340px] xl:h-[485px] w-auto overflow-hidden group"
                            v-for="(itemThumbnail, indexThumbnail) in promotion.images.slice(0, 3)"
                            :key="indexThumbnail"
                        >
                            <JPicture
                                :src="itemThumbnail.url"
                                alt="background event"
                                class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
                            />
                        </div>
                        <div
                            class="relative h-[265px] xl:h-[375px] w-auto overflow-hidden group"
                            v-for="(itemThumbnail, indexThumbnail) in promotion.images.slice(3)"
                            :key="indexThumbnail"
                        >
                            <JPicture
                                :src="itemThumbnail.url"
                                alt="background event"
                                class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
                            />
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-[26px]">
                        <Link :href="route('contact')" class="cursor-pointer block">
                            <Button> {{ tt('Book now') }} </Button>
                        </Link>
                        <a href="tel:090 678 35 78" class="cursor-pointer block">
                            <ButtonLink>{{ tt('Call us') }}</ButtonLink>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <SectionPromotion :textFirst="tt('Other Promotion')" :textSecond="tt('& events')" :items="related_promotions" />
    </main>
</template>
<script>
import CardPromotion from '@/Components/Card/CardPromotion.vue'
import CardPromotionDetail from '@/Components/Card/CardPromotionDetail.vue'

export default {
    components: { CardPromotion, CardPromotionDetail },

    props: ['categories', 'posts', 'banner', 'promotion', 'related_promotions'],
    methods: {
        formatDate(dateString) {
            if (!dateString) return ''
            const [year, month, day] = dateString.split('-')
            return `${day.padStart(2, '0')}.${month.padStart(2, '0')}.${year}`
        },
        getDayOfWeek(dateString) {
            if (!dateString) return ''
            const date = new Date(dateString)
            return date.toLocaleDateString('en-US', { weekday: 'long' })
        },
        formatTime(timeString) {
            // Convert '20:00:00' to '20:00'
            if (!timeString) return ''
            return timeString.slice(0, 5) // Takes the first 5 characters (HH:mm)
        },
    },
}
</script>
