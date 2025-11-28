<template>
    <section class="relative">
        <div class="absolute top-0 left-0 pt-2 pb-8 z-10 w-full">
            <TextAnimation className="text-center" :textFirst="textFirst" :textSecond="textSecond" />
        </div>
        <swiper
            ref="swiperRef"
            :modules="[Autoplay, Pagination]"
            slides-per-view="1"
            space-between="0"
            :loop="true"
            :autoplay="{ delay: 2000, disableOnInteraction: false, pauseOnMouseEnter: true }"
            :pagination="{ clickable: true, el: '.hero-pagination' }"
            @swiper="onSwiperInit"
            class="h-[520px] xl:h-[700px] overflow-hidden relative"
        >
            <swiper-slide v-for="(item, index) in items" :key="index">
                <div class="absolute inset-0">
                    <JPicture
                        :src="item.url"
                        :alt="item.alt || 'image hero'"
                        wrapperClass="picture-cover"
                        class="w-full h-full object-cover"
                    />
                </div>
            </swiper-slide>
        </swiper>
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-10">
            <div class="flex items-center gap-3">
                <div class="paginate-room-border">
                    <div class="paginate-room">
                        <div class="hero-pagination"></div>
                    </div>
                </div>
                <Link :href="route('contact')">
                    <ButtonBook class="shadow-[4px_4px_10px_rgba(217,45,32,0.66)] rounded-full"> {{ tt('Book now') }} </ButtonBook>
                </Link>
            </div>
        </div>
    </section>
</template>

<script>
import { ref, computed } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';
import ButtonBook from './ButtonBook.vue';

export default {
    props: {
        items: {
            type: Array,
            default: () => [],
        },
        title: {
            type: String,
            default: '',
        },
    },
    components: {
        Swiper,
        SwiperSlide,
        ButtonBook,
    },
    setup(props) {
        const swiperRef = ref(null);
        const swiperInstance = ref(null);

        const onSwiperInit = (swiper) => {
            swiperInstance.value = swiper;
        };

        // Split title into textFirst and textSecond
        const textFirst = computed(() => {
            const parts = props.title.split(' ');
            return parts[0] || ''; // First word (e.g., "Luxury")
        });

        const textSecond = computed(() => {
            const parts = props.title.split(' ');
            return parts.slice(1).join(' ') || ''; // Remaining words (e.g., "ROOM")
        });

        return {
            Autoplay,
            Pagination,
            swiperRef,
            onSwiperInit,
            textFirst,
            textSecond,
        };
    },
};
</script>

<style lang="scss" scoped>
/* Style pagination bullets */
:deep(.hero-pagination .swiper-pagination-bullet) {
    width: 10px;
    height: 10px;
    opacity: 0.4;
    background: #fff;
    transition: transform 0.3s ease, opacity 0.3s ease;
}
:deep(.hero-pagination .swiper-pagination-bullet-active) {
    opacity: 1;
    background: #fff;
}
/* Pagination container */
:deep(.hero-pagination) {
    display: flex;
    gap: 2px;
}
</style>