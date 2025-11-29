<template>
    <section class="py-20">
        <div class="container space-y-6">
            <h2 class="title-linear display-2 uppercase font-extrabold text-center">Dự án</h2>
            <div class="grid grid-cols-3 gap-y-5 gap-x-4">
                <CardRoom v-for="(itemProject, indexProject) in projects" :key="indexProject" :item="itemProject" />
            </div>
        </div>
    </section>
</template>

<script>
import CardRoom from './Card/CardRoom.vue'
export default {
    props: ['projects'],
    components: { CardRoom },
}
</script>
