<template>
    <section class="relative z-10 md:space-y-6 space-y-4 xl:space-y-8 overflow-hidden">
        <div class="container">
            <TextAnimation className="text-center" :textFirst="tt('Promotion ')" :textSecond="tt('& events')" />
        </div>
        <div class="relative">
            <swiper
                ref="swiperRef"
                :slides-per-view="4"
                :space-between="32"
                :loop="true"
                :centeredSlides="true"
                :autoplay="{ delay: 1000, disableOnInteraction: false }"
                :breakpoints="{
                    320: { slidesPerView: 1.2, spaceBetween: 40 },
                    768: { slidesPerView: 2, spaceBetween: 5 },
                    1024: { slidesPerView: 2.5, spaceBetween: 5 },
                    1280: { slidesPerView: 3.2, spaceBetween: 0 },
                }"
                @swiper="onSwiperInit"
                class="swiper-promotion-slider"
            >
                <swiper-slide v-for="(item, index) in [...items,...items]" :key="index">
                    <CardPromotionHighlight class="card-promotion" :item="item" />
                </swiper-slide>
            </swiper>
        </div>
    </section>
</template>
<script>
import { ref } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'
import CardPromotionHighlight from './Card/CardPromotionHighlight.vue'

export default {
    props: ['items'],
    components: {
        Swiper,
        SwiperSlide,
        CardPromotionHighlight,
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
.swiper-promotion-slider {
    @apply h-[580px] md:h-[680px] lg:h-[766px];
    overflow: visible;
    // .swiper-wrapper {
    //     @apply flex items-center justify-center;
    // }
    .swiper-slide {
        @apply flex items-center justify-center;
        .card-promotion {
            transition: all 300ms ease-in-out;
            // transform: scale(1);
               width: 314px !important;
        }
        &.swiper-slide-prev,
        &.swiper-slide-next {
            // width: 380px !important;
            .card-promotion {
                width: 380px !important;
                // transform: scale(1.2);
            }
        }
        &.swiper-slide-active {
            // width: 475px !important;
            .card-promotion {
                width: 475px !important;
                // @apply scale-[1.4] lg:scale-[1.5] xl:scale-[1.6];
            }
        }
    }
}
</style>
