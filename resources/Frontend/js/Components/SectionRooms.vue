<template>
    <section class="xl:pt-[120px] xl:pb-[200px] relative py-12 md:py-16">
        <div class="circle-orange-2 left-[-279px] top-[567px]"></div>
        <div class="relative">
            <div class="container md:space-y-6 space-y-8 xl:space-y-8">
                <TextAnimation className="text-center" :textFirst="tt('The Rooms ')" :textSecond="tt('Experiences')" />
                <!-- <div class="grid md:grid-cols-3 gap-4 xl:gap-6">
                    <AnimateAppear animate="slideright" v-for="(itemRoom, indexRoom) in items" :key="indexRoom">
                        <CardRoom :item="itemRoom" />
                    </AnimateAppear>
                </div> -->
                <div class="relative">
                    <swiper
                        ref="swiperRef"
                        :slides-per-view="4"
                        :space-between="32"
                        :loop="false"
                        :autoplay="{ delay: 1000, disableOnInteraction: false }"
                        :breakpoints="{
                            320: { slidesPerView: 1.1, spaceBetween: 10 },
                            768: { slidesPerView: 2, spaceBetween: 16 },
                            1024: { slidesPerView: 3, spaceBetween: 20 },
                            1280: { slidesPerView: 3, spaceBetween: 24 },
                        }"
                        @swiper="onSwiperInit"
                        class="swiper-room"
                    >
                        <swiper-slide v-for="(item, index) in items" :key="index">
                            <AnimateAppear animate="slideright" :delay="index * 50 + 300">
                                 <CardRoom :item="item" />
                            </AnimateAppear>
                        </swiper-slide>
                    </swiper>
                </div>
                <div class="flex items-center justify-center">
                    <Link :href="route('rooms.index')" class="relative z-20">
                        <Button> {{ tt('All rooms ') }} </Button>
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { ref } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'
import CardRoom from './Card/CardRoom.vue'

export default {
    components: { Swiper, SwiperSlide, CardRoom },
    props: ['items'],
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
.swiper-room {
    overflow: visible;
}
</style>
