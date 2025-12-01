<template>
  <section class="py-12 md:py-16 xl:py-20">
    <div class="container space-y-10">
        <div class="flex items-center justify-between">
            <h2 class="title-linear display-2 uppercase font-extrabold text-center">Tin tức</h2>
            <Link :href="route('posts')" class="btn btn-primary">All events</Link>
        </div>
        <div v-if="posts && posts.length > 0" class="grid md:grid-cols-3 gap-4 md:gap-6 xl:gap-8 text-white">
            <CardPost v-for="(itemPost, indexPost) in posts" :key="indexPost" :item="itemPost" />
        </div>
    </div>
  </section>
</template>

<script>
import CardPost from '@/Components/Card/CardPost.vue'

export default {
    components: { CardPost },
    props: ["posts"],
}
</script>
