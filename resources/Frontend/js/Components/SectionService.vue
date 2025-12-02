<template>
    <section class="py-12 xl:py-[60px]">
        <div class="container">
            <h2 class="title-linear display-2 uppercase font-extrabold text-center">Dịch vụ</h2>
        </div>

        <swiper
            ref="swiperRef"
            :modules="[Autoplay, Pagination]"
            slides-per-view="2.8"
            space-between="0"
            :breakpoints="{
                320: { slidesPerView: 1.1, spaceBetween: 10 },
                768: { slidesPerView: 2.2, spaceBetween: 20 },
                1024: { slidesPerView: 2.8, spaceBetween: 20 },
                1280: { slidesPerView: 2.8, spaceBetween: 24 },
            }"
            :loop="true"
            :autoplay="{ delay: 2000, disableOnInteraction: false, pauseOnMouseEnter: true }"
            :pagination="{ clickable: true, el: '.hero-pagination' }"
            @swiper="onSwiperInit"
            :centeredSlides="true"
            class="relative"
        >
            <swiper-slide v-for="(itemService, indexService) in services" :key="indexService" class="py-8 md:py-10 lg:py-16">
                <div @click="handleCardClick(indexService)" class="cursor-pointer">
                    <CardService :item="itemService" />
                </div>
            </swiper-slide>
        </swiper>

        <div v-if="showButton" class="flex items-center justify-center">
            <Link :href="route('services')" class="btn btn-primary">dịch vụ của chúng tôi</Link>
        </div>
    </section>
</template>

<script>
import CardService from '@/Components/Card/CardService.vue'
import { ref } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Autoplay, Pagination } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/pagination'

export default {
    components: { Swiper, SwiperSlide, CardService },
    props: ['services', 'showButton'],
    emits: ['open-modal'],
    setup(props, { emit }) {
        const swiperRef = ref(null)
        const swiperInstance = ref(null)

        const onSwiperInit = (swiper) => {
            swiperInstance.value = swiper
        }

        const handleCardClick = (index) => {
            emit('open-modal', index)
        }

        return {
            Autoplay,
            Pagination,
            swiperRef,
            onSwiperInit,
            handleCardClick,
        }
    },
}
</script>

<style lang="scss" scoped>
.bg-linear-modal {
    background: linear-gradient(180deg, rgba(189, 189, 189, 0.3) 0%, rgba(52, 51, 51, 0.3) 100%);
}
</style>
