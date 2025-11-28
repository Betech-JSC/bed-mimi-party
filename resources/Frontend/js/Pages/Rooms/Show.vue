<template>
    <main class="bg-black text-white">
        <SectionRoomSlider
            v-if="room.images_banner && room.images_banner.length > 0"
            :items="room.images_banner"
            :title="room.title"
        />
        <section class="pt-20 pb-[120px] relative overflow-hidden">
            <div class="circle-orange right-[-307px] top-[-400px]"></div>
            <div class="circle-orange left-[-279px] top-[250px]"></div>
            <div class="relative">
                <div class="container">
                    <div class="max-w-[800px] w-full mx-auto text-center flex flex-col items-center justify-center">
                        <TextAnimation
                            className="text-center"
                            :textFirst="tt('Your room ')"
                            :textSecond="tt('include')"
                        />
                        <div class="body-2 text-white mt-8 mb-12" v-html="room.content"></div>
                        <Link :href="route('contact')">
                            <Button>{{ tt('Book now') }}</Button>
                        </Link>
                    </div>

                    <!-- Gallery hiển thị toàn bộ ảnh chia cột -->
                    <div class="grid grid-cols-2 xl:grid-cols-3 gap-3 md:gap-6 mt-12">
                        <div
                            v-for="(col, colIndex) in galleryCol"
                            :key="colIndex"
                            class="space-y-3 md:space-y-6"
                        >
                            <div
                                v-for="(img, imgIndex) in col"
                                :key="imgIndex"
                                class="w-full"
                            >
                                <JPicture
                                    :src="img.url"
                                    :alt="img.alt || 'room image'"
                                    class="w-full h-auto object-cover"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="xl:pt-[120px] xl:pb-[200px] relative py-12 md:py-16 overflow-hidden">
            <div class="circle-orange-2 left-[-279px] top-[567px]"></div>
            <div class="relative">
                <div class="container md:space-y-6 space-y-8 xl:space-y-8">
                    <TextAnimation className="text-center" :textFirst="tt('More ')" :textSecond="tt('Rooms')" />

                    <div class="grid md:grid-cols-3 gap-4 xl:gap-6">
                        <CardRoom
                            v-for="(itemRoom, indexRoom) in related_rooms.slice(0, 3)"
                            :key="indexRoom"
                            :item="itemRoom"
                        />
                    </div>
                    <div class="flex items-center justify-center">
                        <Link :href="route('home')">
                            <Button>{{ tt('All rooms') }}</Button>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import CardRoom from '@/Components/Card/CardRoom.vue'

export default {
    components: { CardRoom },
    props: ['room', 'related_rooms'],
    data() {
        return {
            galleryCol: [],
        }
    },
    mounted() {
        window.addEventListener('resize', this.handleResize)
        this.handleResize()
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.handleResize)
    },
    methods: {
        groupItemByColumn(items, count) {
            const numRows = Math.ceil(items.length / count)
            let finalCols = []
            for (let col = 0; col < count; col++) {
                let colData = []
                for (let row = 0; row < numRows; row++) {
                    const dataIndex = col + row * count
                    if (dataIndex < items.length) {
                        colData.push(items[dataIndex])
                    }
                }
                finalCols.push(colData)
            }
            return finalCols
        },
        handleResize() {
            const columnCount = window.innerWidth >= 1280 ? 3 : window.innerWidth >= 768 ? 2 : 2
            this.galleryCol = this.groupItemByColumn(this.room.images, columnCount)
        },
    },
}
</script>
