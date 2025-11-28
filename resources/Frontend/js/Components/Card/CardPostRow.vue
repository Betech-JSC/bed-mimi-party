<template>
    <div v-if="item.slug" class="grid grid-cols-12 bg-white group">
        <Link
            :href="
                route('posts.show', {
                    slug: item.slug,
                })
            "
            class="col-span-full md:col-span-7 aspect-w-8 aspect-h-5 relative overflow-hidden block"
        >
            <JPicture
                :src="item.image.url || '/cover.jpg'"
                :alt="item.image.alt || item.title || 'image card post'"
                wrapperClass="picture-cover"
                class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
            />
        </Link>

        <div class="col-span-full md:col-span-5 p-3 md:p-4 xl:p-6 flex items-center justify-center">
            <div class="space-y-3 md:space-y-4 xl:space-y-6">
                <div
                    class="body-2 py-0.5 px-3 bg-primary-100 text-primary-900 rounded-full w-max flex items-center justify-center"
                >
                    <span>{{ item.category.title }}</span>
                </div>
                <div class="space-y-2">
                    <Link
                        :href="
                            route('posts.show', {
                                slug: item.slug,
                            })
                        "
                        class="headline-1 text-gray-900 !font-sans lg:group-hover:text-primary duration-300 ease-in-out"
                    >
                        {{ item.title }}
                    </Link>
                    <p class="body-1 text-gray-700 line-clamp-3">
                        {{ item.description }}
                    </p>
                </div>
                <Link
                    :href="
                        route('posts.show', {
                            slug: item.slug,
                        })
                    "
                    class="btn four"
                    >Xem thêm</Link
                >
            </div>
        </div>
    </div>
</template>

<script setup>
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
