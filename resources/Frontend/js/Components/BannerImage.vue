<template>
    <section class="relative z-10" :class="classBanner ? classBanner : 'h-[280px] md:h-[320px] xl:h-[330px]'">
        <div class="absolute inset-0">
            <JPicture
                :src="banner.image"
                loading="eager"
                class="object-fit h-full w-full object-cover"
                :alt="banner.title"
            />
        </div>
    </section>
</template>
<script>
import JamBreadcrumb from '@/Components/Jam/Breadcrumb.vue'
import LogoSymbol from '@/Components/Icons/LogoSymbol.vue'

export default {
    components: {
        JamBreadcrumb,
        LogoSymbol,
    },
    props: ['banner', 'classBanner'],
}
</script>
