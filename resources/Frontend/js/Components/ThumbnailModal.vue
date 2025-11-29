<template>
    <!-- START SLIDER -->
    <div class="relative">
        <EcomSlider
            :config="{
                cols: '1',
                gutter: '2px',
                total: images.length,
                align: 'start',
            }"
            class="relative grid-cols-12 space-y-4"
            @onChangeSlide="onChangeSlide"
            ref="slider"
        >
            <template #dots="{ navigate, current }">
                <div class="col-span-full grid grid-cols-5 gap-[12px]" :class="images.length >= 5 ? '' : 'space-x-1'">
                    <template v-for="(image, index) in images.slice(0, 5)" :key="index">
                        <div
                            v-if="image"
                            class="cursor-pointer aspect-w-16 aspect-h-9 relative col-span-1"
                            :class="[
                                index === 3 && 'relative',
                                index == current ? 'border-primary-600' : 'border-gray-200',
                            ]"
                            @click="navigate(index)"
                        >
                            <JPicture
                                :src="image.url"
                                class="object-cover w-full h-full"
                                alt="product detail title"
                                loading="eager"
                            />
                            <div class="absolute inset-0" v-if="index === 4" @click="lightboxIndex = index">
                                <div class="absolute inset-0 bg-black opacity-60"></div>
                                <span
                                    class="absolute z-10 text-white -translate-x-1/2 -translate-y-1/2 p2 left-1/2 top-1/2"
                                    >+{{ images.length - 3 }}</span
                                >
                            </div>
                        </div>
                    </template>
                </div>
            </template>
            
            <template #default="{ navigate }">
                <EcomSlide
                    v-for="(image, index) in images"
                    :key="index"
                    class="!border-none lg:min-w-[496px] max-sm:max-w-[300px] relative group"
                >
                    <div class="w-full aspect-w-8 aspect-h-5 !border-none relative" @click="lightboxIndex = index">
                        <!-- IMAGE -->
                        <img
                            :src="image.url || '/assets/images/cover.webp'"
                            class="object-cover w-full h-full"
                            :alt="image.alt"
                        />
                    </div>
                    
                    <!-- Navigation Buttons -->
                    <button
                        v-if="currentIndex > 0"
                        @click.stop="navigate(currentIndex - 1)"
                        class="absolute w-10 h-10 left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-10"
                        aria-label="Previous image"
                    >
                        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    
                    <button
                        v-if="currentIndex < images.length - 1"
                        @click.stop="navigate(currentIndex + 1)"
                        class="absolute w-10 h-10 right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-10"
                        aria-label="Next image"
                    >
                        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </EcomSlide>
            </template>
        </EcomSlider>
    </div>
    <!-- END SLIDER -->
    <EcomLightBox :index="lightboxIndex" :images="images" @change="onChangeLightbox" />
</template>
<script>
import { checkIsVideo, getLinkVideo, getThumbnailVideo } from '@/lib/video'

export default {
    props: ['product'],
    data() {
        return {
            currentIndex: 0,
            lightboxIndex: null,
        }
    },

    computed: {
        images() {
            const videos =
                this.product?.video_urls?.map((vid) => {
                    return {
                        url: vid,
                    }
                }) || []
            return [...this.product?.images, ...videos]
        },
    },

    methods: {
        onChangeSlide(index) {
            this.currentIndex = index
        },
        onChangeLightbox(index) {
            this.lightboxIndex = index
        },
        checkIsVideo,
        getLinkVideo,
        getThumbnailVideo,
    },
}
</script>
