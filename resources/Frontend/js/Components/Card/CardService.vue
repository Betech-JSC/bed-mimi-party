<template>
    <article v-if="item.slug" class="flex relative flex-col justify-center items-start w-[480px]">
        <Link
            :href="
                route('services.show', {
                    slug: item.slug,
                })
            "
            class="block relative overflow-hidden"
        >
            <div class="md:aspect-w-4 md:aspect-h-5 aspect-w-2 aspect-h-1">
                <JPicture
                :src="item.image.url || '/cover.jpg'"
                :alt="item.image.alt || item.title || 'image card service'"
                wrapperClass="picture-cover"
                class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
            />
            </div>
        </Link>
        <div class="flex relative flex-col gap-1.5 justify-center items-start self-stretch px-4 py-6">
            <h3 class="relative self-stretch text-lg font-bold leading-7 text-white">
                <div class="text-lg font-bold text-white max-sm:text-base">
                    {{ item.title }}         {{ item.image }}

                </div>
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
