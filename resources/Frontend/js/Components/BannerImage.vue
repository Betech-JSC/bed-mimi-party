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
        <div class="absolute bg-black/60 inset-0 w-full h-full"></div>
        <div class="relative h-full">
            <div class="container h-full flex items-center justify-center">
                <div class="grid grid-cols-12 gap-4 md:gap-6 xl:gap-8">
                    <div
                        class="col-span-full md:col-span-10 md:col-start-2 space-y-5 flex flex-col justify-center items-center"
                    >
                        <JamBreadcrumb :items="banner.breadcrumbs" :isWhite="true" />
                        <div class="space-y-3 text-center text-white">
                            <TextAnimation className="text-center" :textFirst="banner.titleFirst" :textSecond="banner.titleSecond" />
                        </div>
                    </div>
                </div>
            </div>
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
