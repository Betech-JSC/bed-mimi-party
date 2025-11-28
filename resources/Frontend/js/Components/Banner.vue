<template>
    <div class="min-h-[180px] md:min-h-[200px] xl:min-h-[240px] relative" :class="customClass">
        <div class="bg-banner"></div>
        <div class="container relative z-20">
            <JamBreadcrumb :items="breadcrumbs" class="is-background" :class="breadCrumbClass" />
            <div>
                <slot />
            </div>
        </div>

        <JPicture
            loading="eager"
            alt="shape-banner"
            src="/assets/images/service/shape-banner.png"
            class="absolute inset-y-0 right-0 z-10 opacity-30"
        />
    </div>
</template>
<script>
import JamBreadcrumb from '@/Components/Jam/Breadcrumb.vue'
export default {
    components: { JamBreadcrumb },
    props: ['breadcrumbs', 'customClass', 'breadCrumbClass'],
}
</script>
<style lang="scss">
.bg-banner {
    @apply block bg-gradient-blue w-full h-full object-cover absolute top-0 left-0;
    transform: matrix(-1, 0, 0, 1, 0, 0);
}
</style>
