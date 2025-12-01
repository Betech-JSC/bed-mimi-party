<template>
    <section class="py-12 xl:py-[60px]">
        <div class="container space-y-6">
            <h2 class="title-linear display-2 uppercase font-extrabold md:text-right">Khách hàng tiêu biểu</h2>
            <div class="h-[300px] overflow-y-auto partner-scroll">
                <div class="grid grid-cols-3 md:grid-cols-4 xl:grid-cols-6 gap-y-3 gap-x-3 md:gap-x-6 xl:gap-x-8">
                    <div
                        v-for="(itemPartner, indexPartner) in partners"
                        :key="indexPartner"
                        class="flex items-center justify-center min-h-[100px] grayscale lg:hover:grayscale-0 duration-300 ease-in-out"
                    >
                        <div class="w-auto h-10">
                            <JPicture :src="itemPartner" alt="image partner" class="w-full h-full object-contain" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['partners'],
}
</script>

<style lang="scss" scoped>
/* width */
.partner-scroll::-webkit-scrollbar {
    @apply w-2;
}

/* Track */
.partner-scroll::-webkit-scrollbar-track {
    @apply bg-transparent;
}

/* Handle */
.partner-scroll::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #98cdff 0%, #558dfc 100%);
    border-radius: 10px;
}
</style>
