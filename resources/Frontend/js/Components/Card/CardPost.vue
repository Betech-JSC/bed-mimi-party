<template>
    <div class="relative bg-white/10 border border-white/20 group p-4 space-y-6">
        <Link
            :href="
                route('posts.show', {
                    slug: item.slug || 'demo-slug',
                })
            "
            class="aspect-w-7 aspect-h-5 relative overflow-hidden block"
        >
            <JPicture
                :src="item.image.url || '/cover.jpg'"
                :alt="item.image.alt || item.title || 'image card post'"
                wrapperClass="picture-cover"
                class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
            />
        </Link>

        <div class="space-y-1 md:space-y-2 xl:space-y-3">
            <div class="flex items-center gap-2 text-white">
                <div
                    class="body-3 py-1 px-2.5 bg-primary-900/90 w-max flex items-center justify-center uppercase"
                >
                    <span>{{ item.category.title }}</span>
                </div>
                <div class="body-3">
                    {{ item.created_at }}
                </div>
            </div>
            <div class="space-y-1">
                <Link
                    :href="
                        route('posts.show', {
                            slug: item.slug || 'demo-slug',
                        })
                    "
                    class="title-1 text-white !font-sans lg:group-hover:text-primary duration-300 ease-in-out line-clamp-5"
                >
                    {{ item.title }}
                </Link>
                <p class="body-1 text-white line-clamp-2 md:line-clamp-3">
                    {{ item.description }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import ArrowCircle from '@/Components/Icons/ArrowCircle.vue'
defineProps({
    item: {
        type: Object,
        default: true,
    },
})
</script>
