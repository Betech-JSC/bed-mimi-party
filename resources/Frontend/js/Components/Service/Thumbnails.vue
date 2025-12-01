<template>
    <div class="product-gallery">
        <div class="relative overflow-hidden">
            <div v-if="currentImage" class="relative aspect-w-8 aspect-h-5 bg-gray-100 border border-primary-500">
                <JPicture
                    :src="currentImage.url || '/assets/images/cover.webp'"
                    class="w-full h-full object-cover"
                    :alt="currentImage.alt || 'Product image'"
                />
            </div>
        </div>

        <!-- Thumbnail Swiper -->
        <div v-if="images.length > 1" class="thumbnail-swiper-container mt-4">
            <Swiper
                @swiper="setThumbsSwiper"
                :modules="[Navigation]"
                :space-between="12"
                :slides-per-view="4"
                :watch-slides-progress="true"
                :breakpoints="{
                    320: { slidesPerView: 3, spaceBetween: 8 },
                    640: { slidesPerView: 4, spaceBetween: 10 },
                    1024: { slidesPerView: 5, spaceBetween: 12 },
                }"
                :navigation="{
                    prevEl: '.thumbnail-prev',
                    nextEl: '.thumbnail-next',
                }"
                class="thumbnail-swiper"
            >
                <SwiperSlide
                    v-for="(image, index) in images"
                    :key="index"
                    class="cursor-pointer"
                    @click="selectImage(index)"
                >
                    <div
                        class="relative overflow-hidden transition-all duration-300 aspect-w-3 aspect-h-2"
                        :class="currentSlideIndex === index ? 'opacity-100' : 'opacity-20 hover:opacity-75'"
                    >
                        <img
                            :src="image.url || '/assets/images/cover.webp'"
                            class="w-full h-full object-cover select-none"
                            :alt="image.alt || `Thumbnail ${index + 1}`"
                        />
                    </div>
                </SwiperSlide>
            </Swiper>

            <!-- Navigation Buttons -->
            <button
                v-if="images.length > 5"
                class="thumbnail-prev btn-navigation -left-12 "
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button
                v-if="images.length > 5"
                class="thumbnail-next btn-navigation -right-12"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation } from 'swiper/modules'

// Import Swiper styles
import 'swiper/css'
import 'swiper/css/navigation'
import JPicture from '@toannguyen112/bed-library-essentials/src/js/components/JPicture.vue'

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
})

const images = computed(() => props.product?.images || [])

// Swiper instance
const thumbsSwiper = ref(null)
const currentSlideIndex = ref(0)

// Computed để lấy ảnh hiện tại
const currentImage = computed(() => {
    if (images.value && images.value.length > 0) {
        return images.value[currentSlideIndex.value]
    }
    return null
})

const setThumbsSwiper = (swiper) => {
    thumbsSwiper.value = swiper
}

// Function để chọn ảnh khi click vào thumbnail
const selectImage = (index) => {
    currentSlideIndex.value = index
    console.log('Đã chọn ảnh:', index, currentImage.value)
}

// Expose để component cha có thể truy cập
defineExpose({
    currentSlideIndex,
    currentImage,
    selectImage,
})
</script>

<style scoped>
.product-gallery {
  @apply max-w-[816px] mx-auto;
}

.thumbnail-swiper-container {
    @apply relative max-w-[550px] lg:max-w-[720px] mx-auto;
}

.thumbnail-swiper {
    padding: 12px 0;
}

.thumbnail-prev,
.thumbnail-next {
    opacity: 0.9;
}

.thumbnail-prev:hover,
.thumbnail-next:hover {
    opacity: 1;
    background-color: #f7f7f7;
}

/* Transition mượt mà cho ảnh chính */
.main-swiper img {
    transition: opacity 0.3s ease-in-out;
}
.btn-navigation {
    @apply rounded-lg text-white py-2 px-2.5 absolute top-1/2 -translate-y-1/2 z-10 hidden md:flex items-center justify-center hover:bg-gray-100 transition;
    background: linear-gradient(90deg, #98cdff 0%, #558dfc 100%);
    box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
}
</style>
