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
            <!-- Fallback nếu không có ảnh -->
            <div
                v-else
                class="relative aspect-w-8 aspect-h-5 bg-gray-100 border border-primary-500 flex items-center justify-center"
            >
                <span class="text-gray-400">No image available</span>
            </div>
        </div>

        <!-- Thumbnail Swiper -->
        <div v-if="images.length > 1" class="thumbnail-swiper-container mt-4">
            <Swiper
                @swiper="setThumbsSwiper"
                :modules="modules"
                :space-between="12"
                :slides-per-view="5"
                :watch-slides-progress="true"
                :breakpoints="{
                    320: { slidesPerView: 3, spaceBetween: 8 },
                    640: { slidesPerView: 4, spaceBetween: 10 },
                    1024: { slidesPerView: 5, spaceBetween: 12 },
                }"
                :navigation="{
                    prevEl: '.thumbnail-prev-modal',
                    nextEl: '.thumbnail-next-modal',
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
                        class="relative overflow-hidden transition-all duration-300 mr-2 max-w-[120px]"
                        :class="[currentSlideIndex === index ? 'opacity-100' : 'opacity-50 lg:hover:opacity-75']"
                        style="aspect-ratio: 3/2"
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
            <button v-if="images.length > 5" class="thumbnail-prev-modal btn-navigation -left-12" aria-label="Previous">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button v-if="images.length > 5" class="thumbnail-next-modal btn-navigation -right-12" aria-label="Next">
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

components: { Swiper, SwiperSlide }

const props = defineProps({
    product: {
        type: Object,
        required: true,
        default: () => ({ images: [] }),
    },
})

// Khai báo modules để pass vào Swiper
const modules = [Navigation]

// Lấy images từ product
const images = computed(() => {
    return props.product?.images || props.product?.sliders || []
})

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
    if (thumbsSwiper.value) {
        thumbsSwiper.value.slideTo(index)
    }
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
    @apply py-3;
}

.thumbnail-prev-modal,
.thumbnail-next-modal {
    opacity: 0.9;
}

.thumbnail-prev-modal:hover,
.thumbnail-next-modal:hover {
    opacity: 1;
}

/* Transition mượt mà cho ảnh chính */
.product-gallery img {
    @apply transition-opacity duration-300 ease-in-out;
}

.btn-navigation {
    @apply rounded-lg text-white py-2 px-2.5 absolute top-1/2 -translate-y-1/2 z-10 hidden md:flex items-center justify-center transition;
    background: linear-gradient(90deg, #98cdff 0%, #558dfc 100%);
    box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
}

.btn-navigation:hover {
    opacity: 0.9;
}

.btn-navigation:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Fix aspect ratio cho thumbnail */
.swiper-slide {
    width: auto !important;
}
</style>
