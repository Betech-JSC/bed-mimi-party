<template>
    <section class="relative z-10" :class="classBanner ? classBanner : 'h-[280px] md:h-[320px] xl:h-[330px]'">
        <div class="absolute inset-0">
            <JPicture
                :src="banner?.image?.url || banner?.image || banner || '/assets/images/projects/bg-banner.jpg'"
                loading="eager"
                class="object-fit h-full w-full object-cover"
                :alt="banner?.title || banner?.image?.alt || 'Banner'"
            />
        </div>
    </section>
</template>
<script>
export default {
    props: ['banner', 'classBanner'],
}
</script>
