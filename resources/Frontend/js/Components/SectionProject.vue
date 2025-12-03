<template>
    <section v-if="projects && projects.length > 0" class="md:py-16 py-12 xl:py-20">
        <div class="container space-y-6">
            <h2 class="title-linear display-2 uppercase font-extrabold text-center">Dự án</h2>
            <div>
                <div class="hidden md:grid grid-cols-3 gap-y-5 gap-x-4">
                    <CardRoom
                        v-for="(itemProject, indexProject) in projects.slice(0, 9)"
                        :key="indexProject"
                        :item="itemProject"
                    />
                </div>
                <div class="grid grid-cols-2 gap-y-4 gap-x-3 md:hidden">
                    <CardRoom
                        v-for="(itemProject, indexProject) in projects"
                        :key="indexProject"
                        :item="itemProject"
                    />
                </div>
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
