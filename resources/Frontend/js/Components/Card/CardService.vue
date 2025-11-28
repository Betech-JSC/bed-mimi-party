<template>
    <article v-if="item.slug" class="relative bg-white group">
        <Link
            :href="
                route('services.show', {
                    slug: item.slug,
                })
            "
            class="block relative overflow-hidden"
            :class="isLarge ? 'aspect-w-2 aspect-h-1' : 'md:aspect-w-4 md:aspect-h-5 aspect-w-2 aspect-h-1'"
        >
            <JPicture
                :src="item.image.url || '/cover.jpg'"
                :alt="item.image.alt || item.title || 'image card service'"
                wrapperClass="picture-cover"
                class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
            />
        </Link>
        <div class="relative" :class="isLarge ? 'px-6 py-4 md:px-8 md:py-6 space-y-4' : 'px-6 py-4 space-y-[15px]'">
            <div :class="isLarge ? 'space-y-2 md:space-y-4' : 'space-y-2 md:space-y-3'">
                <Link
                    :href="
                        route('services.show', {
                            slug: item.slug,
                        })
                    "
                    class="uppercase lg:group-hover:text-primary-800 duration-300 ease-in-out line-clamp-2"
                    :class="isLarge ? 'headline-3' : 'title-1 !font-display'"
                >
                    {{ item.title }}
                </Link>
                <div
                    class="text-gray-900 font-third"
                    :class="isLarge ? 'body-1 line-clamp-2' : 'body-2 line-clamp-4 h-[84px]'"
                >
                    {{ item.description }}
                </div>
            </div>
            <Link
                :href="
                    route('services.show', {
                        slug: item.slug,
                    })
                "
                class="flex items-center gap-2 text-primary-700 lg:hover:text-primary-900 duration-300 ease-in-out"
            >
                <ArrowCircle />
                <span>Xem thêm</span>
            </Link>
        </div>
    </article>
</template>
<script>
import ArrowCircle from '@/Components/Icons/ArrowCircle.vue'

export default {
    components: { ArrowCircle },
    props: {
        item: {
            type: Object,
            required: true,
        },
        isLarge: {
            type: Boolean,
            default: false,
        },
    },
}
</script>
