<template>
  <section class="py-20">
    <div class="container space-y-10">
        <div class="flex items-center justify-between">
            <h2 class="title-linear display-2 uppercase font-extrabold text-center">Tin tức</h2>
            <button class="btn btn-primary">All events</button>
        </div>
        <div class="grid grid-cols-3 gap-8">
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
