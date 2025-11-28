<template>
    <main class="bg-black">
        <BannerImage :banner="banner" classBanner="h-[380px]" />
        <section class="md:py-16 py-12 xl:py-20 relative overflow-hidden">
            <div class="circle-orange right-[-257px] top-[-190px]"></div>
            <div class="circle-orange-2 left-[-279px] top-[403px]"></div>
            <div v-if="rooms && rooms.length" class="relative">
                <div class="container">
                    <div class="grid grid-cols-2 lg:grid-cols-3 md:gap-x-4 gap-x-4 gap-y-8 md:gap-y-6 xl:gap-x-6 xl:gap-y-8">
                        <CardRoom v-for="(item, indexRoom) in rooms" :key="indexRoom" :item="item" />
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
import CardRoom from '@/Components/Card/CardRoom.vue';

export default {
    props: ['rooms', 'banner'],
    components: {CardRoom},
    data() {
        return {
            banner: {
                titleFirst: this.tt('The Rooms '),
                titleSecond: this.tt('Experiences'),
                image: this.tt('/assets/images/room/bg-banner.jpg'),
            },
        }
    },
}
</script>
