<template>
        <section class="py-12 xl:py-[60px] md:space-y-8 space-y-5 xl:space-y-10">
            <div class="container">
                <h2 class="title-linear display-2 uppercase font-extrabold text-center">Dịch vụ</h2>
            </div>

            <div v-if="services && services.length > 0" class="grid md:grid-cols-3 gap-4">
                <CardService v-for="(itemService, indexService) in services" :key="indexService" :item="itemService" />
            </div>

            <div v-if="showButton" class="flex items-center justify-center">
                <Link :href="route('rooms.index')" class="btn btn-primary">dịch vụ của chúng tôi</Link>
            </div>
        </section>
</template>
<script>
import CardService from '@/Components/Card/CardService.vue'

export default {
    components: { CardService },
    props: ['services', 'showButton'],
}
</script>
