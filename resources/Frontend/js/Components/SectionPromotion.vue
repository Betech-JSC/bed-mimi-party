<template>
    <section class="py-12 md:py-16 xl:py-20 relative z-10 overflow-hidden">
        <div class="container space-y-12">
            <div>
                <TextAnimation :textFirst="textFirst" :textSecond="textSecond" />
                <div
                    class="flex md:flex-row flex-col md:items-center justify-end w-full gap-y-4 md:gap-8 xl:gap-[61px]"
                >
                    <div class="md:flex md:items-center md:gap-6 xl:gap-12 w-full">
                        <div class="md:flex-shrink-0 title-3 text-white uppercase max-md:mt-4">
                            {{ tt('Những sự kiện ưu đãi sắp diễn ra') }}
                        </div>
                        <div class="w-full h-px bg-white md:block hidden"></div>
                    </div>
                    <div class="flex-1">
                        <Link :href="route('promotions.index')">
                            <Button> {{ tt('All events') }} </Button>
                        </Link>
                    </div>
                </div>
            </div>

            <div class="relative">
                <swiper
                    ref="swiperRef"
                    :slides-per-view="4"
                    :space-between="32"
                    :loop="false"
                    :autoplay="{ delay: 1000, disableOnInteraction: false }"
                    :breakpoints="{
                        320: { slidesPerView: 1.1, spaceBetween: 10 },
                        768: { slidesPerView: 2.4, spaceBetween: 16 },
                        1024: { slidesPerView: 3.2, spaceBetween: 20 },
                        1280: { slidesPerView: 3.45, spaceBetween: 24 },
                    }"
                    @swiper="onSwiperInit"
                    class="swiper-promotion"
                >
                    <swiper-slide v-for="(item, index) in items" :key="index">
                        <AnimateAppear animate="slideright" :delay="index * 50 + 300">
                            <CardEvent :item="item" />
                        </AnimateAppear>
                    </swiper-slide>
                </swiper>
            </div>
        </div>
    </section>
</template>
<script>
import { ref } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'
import CardEvent from './Card/CardEvent.vue'

export default {
    props: ['items', 'textFirst', 'textSecond'],
    components: {
        Swiper,
        SwiperSlide,
        CardEvent,
    },
    setup(props) {
        const swiperRef = ref(null) // Tạo ref cho Swiper
        const swiperInstance = ref(null) // Tạo ref để lưu instance Swiper

        // Lấy instance Swiper từ sự kiện
        const onSwiperInit = (swiper) => {
            swiperInstance.value = swiper
        }

        // Xử lý sự kiện nút Previous
        const onPrevClick = () => {
            if (swiperInstance.value) {
                swiperInstance.value.slidePrev()
            } else {
                console.error('Swiper instance not initialized yet.')
            }
        }

        // Xử lý sự kiện nút Next
        const onNextClick = () => {
            if (swiperInstance.value) {
                swiperInstance.value.slideNext()
            } else {
                console.error('Swiper instance not initialized yet.')
            }
        }

        return {
            swiperRef,
            onPrevClick,
            onNextClick,
            onSwiperInit,
        }
    },
}
</script>

<style lang="scss" scoped>
.swiper-promotion {
    overflow: visible;
}
</style>
