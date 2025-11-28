<template>
    <div v-if="item.slug" class="relative md:space-y-4 space-y-2 xl:space-y-6 group">
        <Link
            :href="
                route('posts.show', {
                    slug: item.slug,
                })
            "
            class="aspect-w-8 aspect-h-5 relative overflow-hidden block"
        >
            <JPicture
                :src="item.image.url || '/cover.jpg'"
                :alt="item.image.alt || item.title || 'image card post'"
                wrapperClass="picture-cover"
                class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
            />
        </Link>

        <div class="space-y-1 md:space-y-2 xl:space-y-3">
            <div
                class="body-2 py-0.5 px-3 bg-primary-100 text-primary-900 rounded-full w-max flex items-center justify-center"
            >
                <span>{{ item.category.title }}</span>
            </div>
            <div class="space-y-1">
                <Link
                    :href="
                        route('posts.show', {
                            slug: item.slug,
                        })
                    "
                    class="title-1 text-gray-900 !font-sans line-clamp-1 lg:group-hover:text-primary duration-300 ease-in-out"
                >
                    {{ item.title }}
                </Link>
                <p class="body-1 text-gray-700 line-clamp-2 md:line-clamp-3">
                    {{ item.description }}
                </p>
            </div>
            <Link
                :href="
                    route('posts.show', {
                        slug: item.slug,
                    })
                "
                class="flex items-center gap-2 text-primary-700 duration-300 ease-in-out lg:hover:text-primary-900"
            >
                <ArrowCircle />
                <span>Xem thêm</span>
            </Link>
        </div>
    </div>
</template>

<script setup>
import ArrowCircle from '@/Components/Icons/ArrowCircle.vue'
defineProps({
    item: {
        type: Object,
        required: true,
        default: () => ({
            title: '',
            description: '',
            image: '',
            date: '',
            readTime: 0,
        }),
    },
})
</script>
