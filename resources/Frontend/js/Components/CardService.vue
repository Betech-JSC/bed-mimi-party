<template>
    <article class="flex relative flex-col justify-center items-start w-full group lg:hover:scale-105 duration-300 ease-in-out">
        <div class="block relative overflow-hidden aspect-w-4 aspect-h-5 w-full h-full">
            <JPicture
                :src="item.image.url || '/cover.jpg'"
                :alt="item.image.alt || item.title || 'image card service'"
                wrapperClass="picture-cover"
                class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
            />
            <div class="bg-overlay absolute inset-0 z-10 w-full h-full flex items-center justify-center opacity-0 lg:group-hover:opacity-100 duration-300 ease-in-out">
                <button class="btn btn-primary min-w-[222px] justify-center">Xem chi tiết</button>
            </div>
        </div>
        <div class="relative py-6 px-4 w-full">
            <div class="absolute inset-0 bg-linear w-full h-full"></div>
            <h3 class="relative title-2 font-bold text-white w-full line-clamp-1">
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
.bg-overlay {
    background: linear-gradient(180deg, rgba(3, 36, 95, 0) 0%, #03245F 100%);
}
</style>
