<template>
  <div class="product-gallery">
    <!-- MAIN SWIPER - Ảnh chính -->
    <Swiper
      :modules="[Thumbs, Navigation]"
      :thumbs="{ swiper: thumbsSwiper && !thumbsSwiper.destroyed ? thumbsSwiper : null }"
      :loop="false"
      :space-between="10"
      :navigation="{
        prevEl: '.swiper-main-prev',
        nextEl: '.swiper-main-next',
      }"
      class="main-swiper rounded-xl overflow-hidden shadow-2xl relative"
      @swiper="setMainSwiper"
      @slide-change="onSlideChange"
    >
      <SwiperSlide v-for="(image, index) in images" :key="index">
        <div class="relative aspect-w-16 aspect-h-9 bg-gray-50">
          <JPicture
            :src="image.url || '/assets/images/cover.webp'"
            class="w-full h-full object-cover"
            :alt="image.alt || `Product image ${index + 1}`"
            loading="lazy"
          />
          <!-- Số thứ tự -->
          <div class="absolute top-4 left-4 bg-black/60 text-white px-3 py-1.5 rounded-full text-sm backdrop-blur-sm">
            {{ index + 1 }} / {{ images.length }}
          </div>
        </div>
      </SwiperSlide>

      <!-- Nút Prev/Next cho ảnh chính -->
      <button class="swiper-main-prev absolute left-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white/90 backdrop-blur shadow-xl flex items-center justify-center hover:bg-white hover:scale-110 transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button class="swiper-main-next absolute right-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white/90 backdrop-blur shadow-xl flex items-center justify-center hover:bg-white hover:scale-110 transition-all">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </Swiper>

    <!-- THUMBNAIL SWIPER - Chỉ hiện khi có nhiều hơn 1 ảnh -->
    <div v-if="images.length > 1" class="thumbnail-swiper-container mt-6">
      <Swiper
        :modules="[Thumbs, Navigation]"
        :slides-per-view="5"
        :space-between="12"
        :watch-slides-progress="true"
        :breakpoints="{
          320: { slidesPerView: 3, spaceBetween: 8 },
          640: { slidesPerView: 4, spaceBetween: 10 },
          1024: { slidesPerView: 5, spaceBetween: 12 }
        }"
        :navigation="{
          prevEl: thumbnailPrevEl,
          nextEl: thumbnailNextEl
        }"
        class="thumbnail-swiper"
        @swiper="setThumbsSwiper"
      >
        <SwiperSlide
          v-for="(image, index) in images"
          :key="index"
          class="cursor-pointer select-none"
          :class="{ 'opacity-60': slideIndex !== index }"
        >
          <div
            class="relative overflow-hidden rounded-lg border-3 transition-all duration-300 shadow-md"
            :class="slideIndex === index ? 'border-primary-600 ring-4 ring-primary-600/30 shadow-xl' : 'border-transparent'"
          >
            <JPicture
              :src="image.url || '/assets/images/cover.webp'"
              class="w-full h-24 object-cover pointer-events-none"
              :alt="`Thumbnail ${index + 1}`"
            />
          </div>
        </SwiperSlide>
      </Swiper>

      <!-- Nút Prev/Next cho Thumbnail - Chỉ hiện khi > 5 ảnh -->
      <button
        v-if="images.length > 5"
        ref="thumbnailPrevEl"
        class="absolute left-0 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center hover:bg-gray-50 transition"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>

      <button
        v-if="images.length > 5"
        ref="thumbnailNextEl"
        class="absolute right-0 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center hover:bg-gray-50 transition"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, nextTick } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Thumbs, Navigation } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/thumbs'

const props = defineProps({
  product: {
    type: Object,
    required: true
  }
})

const images = computed(() => props.product?.images || [])

// Swiper refs
const thumbsSwiper = ref(null)
const mainSwiper = ref(null)
const slideIndex = ref(0)

// Ref cho nút thumbnail
const thumbnailPrevEl = ref(null)
const thumbnailNextEl = ref(null)

const setThumbsSwiper = (swiper) => {
  thumbsSwiper.value = swiper
  // Quan trọng: Cập nhật lại thumbs cho main swiper sau khi thumbnail khởi tạo xong
  nextTick(() => {
    if (mainSwiper.value) {
      mainSwiper.value.thumbs.init()
      mainSwiper.value.thumbs.update()
    }
  })
}

const setMainSwiper = (swiper) => {
  mainSwiper.value = swiper
}

const onSlideChange = (swiper) => {
  slideIndex.value = swiper.activeIndex
}
</script>

<style scoped>
.product-gallery {
  max-width: 800px;
  margin: 0 auto;
}

.main-swiper {
  height: 500px;
}

.thumbnail-swiper-container {
  position: relative;
  max-width: 640px;
  margin: 0 auto;
}

.thumbnail-swiper {
  padding: 16px 40px; /* Để chỗ cho nút prev/next */
}

/* Ẩn nút mặc định của Swiper */
.swiper-button-disabled {
  opacity: 0.35;
  cursor: not-allowed;
}

/* Aspect ratio 16:9 */
.aspect-w-16 {
  position: relative;
  padding-bottom: 56.25%;
}
.aspect-w-16 > :deep(img),
.aspect-w-16 > :deep(.j-picture),
.aspect-w-16 > img {
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
}
</style>
