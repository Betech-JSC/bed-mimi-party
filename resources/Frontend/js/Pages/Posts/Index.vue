<template>
    <main class="bg-primary-900">
        <section v-if="posts.data && posts.data.length > 0" class="relative z-10 h-[500px] xl:h-[720px]">
            <div class="absolute inset-0">
                <JPicture
                    src="/assets/images/demo/image-blog-demo.jpg"
                    loading="eager"
                    class="object-fit h-full w-full object-cover"
                    alt="image demo"
                />
            </div>
            <div class="absolute inset-0 w-full h-full bg-[#010A1C] bg-opacity-[56%]"></div>
            <div class="relative pb-4 md:pb-5 xl:pb-6 h-full">
                <div class="container flex items-end mt-auto h-full">
                    <div class="text-white space-y-4 xl:space-y-5">
                        <Link
                            :href="
                                route('posts.show', {
                                    slug: posts.data[0].slug || 'demo-slug',
                                })
                            "
                            class="display-3 font-extrabold uppercase line-clamp-2"
                        >
                            {{ posts.data[0].title }}
                        </Link>
                        <div class="flex items-center gap-3">
                            <div class="title-2">Tên tác giả</div>
                            <div>|</div>
                            <div class="body-1">{{ formatDate(posts.data[0].published_at) }}</div>
                        </div>
                        <div class="title-2 !font-normal line-clamp-2 md:line-clamp-3">
                            {{ posts.data[0].description }}
                        </div>
                        <Link
                            :href="
                                route('posts.show', {
                                    slug: posts.data[0]?.slug || 'demo-slug',
                                })
                            "
                            class="btn btn-primary"
                            >Xem thêm</Link
                        >
                    </div>
                </div>
            </div>
        </section>
        <section class="md:py-16 py-12 xl:py-20">
            <div class="container">
                <div class="grid md:grid-cols-2 grid-cols-1 lg:grid-cols-3 md:gap-6 gap-4 xl:gap-8">
                    <CardPost v-for="(itemPost, indexPost) in posts.data.slice(1)" :key="indexPost" :item="itemPost" />
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import CardPost from '@/Components/Card/CardPost.vue'

export default {
    components: { CardPost },
    props: ['categories', 'posts', 'banner'],
        methods: {
        formatDate(dateString) {
            // Convert '2025-09-05' to '05.09.2025'
            if (!dateString) return ''
            const [year, month, day] = dateString.split('-')
            return `${day.padStart(2, '0')}-${month.padStart(2, '0')}-${year}`
        },
    }
}
</script>
