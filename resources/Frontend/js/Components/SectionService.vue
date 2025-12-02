<template>
    <section class="py-12 xl:py-[60px]">
        <div class="container">
            <h2 class="title-linear display-2 uppercase font-extrabold text-center">Dịch vụ</h2>
        </div>

        <!-- <div v-if="services && services.length > 0" class="grid md:grid-cols-3 gap-4">
                <CardService v-for="(itemService, indexService) in services" :key="indexService" :item="itemService" />
            </div> -->
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
                <CardService :item="itemService" />
            </swiper-slide>
        </swiper>

        <div v-if="showButton" class="flex items-center justify-center">
            <Link :href="route('services')" class="btn btn-primary">dịch vụ của chúng tôi</Link>
        </div>
    </section>
</template>
<script>
import CardService from '@/Components/Card/CardService.vue'
import { ref, computed } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Autoplay, Pagination } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/pagination'

export default {
    components: { Swiper, SwiperSlide, CardService },
    props: ['services', 'showButton'],
    setup(props) {
        const swiperRef = ref(null)
        const swiperInstance = ref(null)

        const onSwiperInit = (swiper) => {
            swiperInstance.value = swiper
        }

        // Split title into textFirst and textSecond
        const textFirst = computed(() => {
            const parts = props.title.split(' ')
            return parts[0] || '' // First word (e.g., "Luxury")
        })

        const textSecond = computed(() => {
            const parts = props.title.split(' ')
            return parts.slice(1).join(' ') || '' // Remaining words (e.g., "ROOM")
        })

        return {
            Autoplay,
            Pagination,
            swiperRef,
            onSwiperInit,
            textFirst,
            textSecond,
        }
    },
}
</script>
