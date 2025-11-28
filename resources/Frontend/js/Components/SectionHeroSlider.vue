<template>
    <section class="relative">
        <swiper
            ref="swiperRef"
            :modules="[Autoplay, Pagination]"
            :slides-per-view="1"
            :space-between="0"
            :loop="true"
            :autoplay="{ delay: 2000, disableOnInteraction: false, pauseOnMouseEnter: true }"
            :breakpoints="breakpoints"
            :pagination="{ clickable: true, el: '.hero-pagination' }"
            @swiper="onSwiperInit"
            class="h-[520px] xl:h-[700px] overflow-hidden relative"
        >
            <swiper-slide v-for="(item, index) in items" :key="index">
                <div class="absolute inset-0">
                    <JPicture
                        :src="item.image.url || '/assets/images/home/bg-hero.webp'"
                        :srcMb="item.image_mobile.url || item.image.url || '/assets/images/home/bg-hero.webp'"
                        :alt="item.image.alt || item.title || 'image hero'"
                        wrapperClass="picture-cover"
                        class="w-full h-full object-cover"
                    />
                </div>
                <div class="absolute inset-0 bg-black/20 w-full h-full"></div>
                <div class="absolute inset-0 w-[789px] h-full bg-gradient-hero"></div>
                <div class="relative h-full">
                    <div class="container h-full">
                        <div class="grid grid-cols-12 gap-4 md:gap-6 xl:gap-8 h-full">
                            <div
                                class="col-span-full md:col-span-8 lg:col-span-7 xl:col-span-6 flex items-center justify-center h-full"
                            >
                                <div class="space-y-5 md:space-y-[24px] xl:space-y-[30px]">
                                    <h1 class="display-1 text-primary-100 uppercase notranslate">
                                        {{ item.title || '' }}
                                    </h1>
                                    <a
                                        v-if="item.link"
                                        :href="item.link"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn primary space-x-3 flex items-center justify-center"
                                    >
                                        <span>{{ tt('Nhận tư vấn ngay') }}</span>
                                        <Arrow />
                                    </a>
                                    <Link
                                        v-else
                                        :href="route('contact')"
                                        class="btn primary space-x-3 flex items-center justify-center"
                                    >
                                        <span>{{ tt('Nhận tư vấn ngay') }}</span>
                                        <Arrow />
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </swiper-slide>
        </swiper>

        <!-- Pagination đặt ngoài để dễ style/định vị -->
        <div class="hero-pagination absolute left-1/2 -translate-x-1/2 bottom-6 z-10"></div>
    </section>
</template>

<script>
import { ref } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Autoplay, Pagination } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/pagination'

import CardPost from './Card/CardPost.vue'
import ArrowSlider from '@/Components/Icons/ArrowSlider.vue'
import Arrow from '@/Components/Icons/Arrow.vue'

export default {
    props: {
        items: {
            type: Array,
            default: () => [],
        },
        breakpoints: {
            type: Object,
            default: () => ({
                320: { slidesPerView: 1, spaceBetween: 0 },
                768: { slidesPerView: 1, spaceBetween: 0 },
                1024: { slidesPerView: 1, spaceBetween: 0 },
            }),
        },
    },
    components: {
        Swiper,
        SwiperSlide,
        CardPost,
        ArrowSlider,
        Arrow,
    },
    setup() {
        const swiperRef = ref(null)
        const swiperInstance = ref(null)

        const onSwiperInit = (swiper) => {
            swiperInstance.value = swiper
        }

        const onPrevClick = () => {
            swiperInstance.value
                ? swiperInstance.value.slidePrev()
                : console.error('Swiper instance not initialized yet.')
        }

        const onNextClick = () => {
            swiperInstance.value
                ? swiperInstance.value.slideNext()
                : console.error('Swiper instance not initialized yet.')
        }

        return {
            Autoplay,
            Pagination,
            swiperRef,
            // onPrevClick,
            // onNextClick,
            onSwiperInit,
        }
    },
}
</script>

<style lang="scss" scoped>
/* Style pagination bullets */
:deep(.hero-pagination .swiper-pagination-bullet) {
    width: 8px;
    height: 8px;
    opacity: 0.5;
    background: #fff;
    transition: transform 0.2s ease, opacity 0.2s ease;
}
:deep(.hero-pagination .swiper-pagination-bullet-active) {
    transform: scale(1.2);
    opacity: 1;
    background: #fff;
}
/* Tuỳ chọn: giãn cách bullets */
:deep(.hero-pagination) {
    display: flex;
    gap: 10px;
}
</style>
