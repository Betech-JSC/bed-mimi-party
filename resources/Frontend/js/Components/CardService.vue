<template>
    <article v-if="item.slug" class="flex relative flex-col justify-center items-start w-full">
        <Link
            :href="
                route('services.show', {
                    slug: item.slug,
                })
            "
            class="block relative overflow-hidden md:aspect-w-4 md:aspect-h-5 aspect-w-2 aspect-h-1 w-full h-full"
        >
            <JPicture
                :src="item.image.url || '/cover.jpg'"
                :alt="item.image.alt || item.title || 'image card service'"
                wrapperClass="picture-cover"
                class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
            />
        </Link>
        <div class="relative py-6 px-4 w-full">
            <div class="absolute inset-0 bg-linear w-full h-full"></div>
            <h3 class="relative title-2 font-bold text-white w-full">
                {{ item.title }}
            </h3>
        </div>
    </article>
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
}
</script>
<style lang="scss" scoped>
.bg-linear {
    background: linear-gradient(91.96deg, #032665 0%, #01050e 100%);
}
</style>
