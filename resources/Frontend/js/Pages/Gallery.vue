<template>
    <main class="bg-black">
        <section class="pt-12 md:pb-16 pb-12 xl:pb-20 relative overflow-hidden">
            <div class="container space-y-12">
                <TextAnimation className="text-center" :textFirst="tt('Our ')" :textSecond="tt('Gallery')" />

                <div class="mx-auto w-full flex items-center justify-center flex-wrap">
                    <div
                        v-for="(item, index) in categories"
                        :key="index"
                        :class="[
                            'body-1 border-b py-2.5 px-2 text-gray-400 uppercase !font-display cursor-pointer',
                            selectedCategory === item ? 'border-primary text-white' : 'border-gray-300',
                        ]"
                        @click="selectCategory(item)"
                    >
                        {{ item }}
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-5 gap-3 md:gap-6 xl:gap-8">
                    <div
                        v-for="(itemGalleryCol, indexGalleryCol) in galleryCol"
                        :key="indexGalleryCol"
                        class="md:space-y-6 space-y-3 xl:space-y-8"
                    >
                        <div
                            v-for="(resource, index) in itemGalleryCol"
                            :key="index"
                            class="w-full group"
                            @click="openModal(resource)"
                        >
                            <div class="relative group overflow-hidden">
                                <JPicture
                                    :src="resource.url"
                                    :alt="resource.alt"
                                    class="w-full h-auto object-cover lg:group-hover:scale-110 duration-300 ease-in-out"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center" v-if="canShowMore">
                    <ButtonBook class="cursor-pointer" @click="loadMore">Xem thêm</ButtonBook>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
export default {
    props: ['galleries'],
    data() {
        return {
            categories: [this.tt('All'), ...new Set(this.galleries.map((item) => item.title))],
            selectedCategory: this.tt('All'),
            galleryCol: [],
            displayCount: 20,
        }
    },
    computed: {
        filteredGalleries() {
            let allImages = this.galleries.flatMap(gallery => 
                gallery.images.map(image => ({
                    ...image,
                    title: gallery.title
                }))
            )
            if (this.selectedCategory === this.tt('All')) {
                return allImages
            }
            return allImages.filter((item) => item.title === this.selectedCategory)
        },
        visibleGalleries() {
            // 👇 Trộn random trước khi cắt displayCount
            return this.shuffleArray(this.filteredGalleries).slice(0, this.displayCount)
        },
        canShowMore() {
            return this.displayCount < this.filteredGalleries.length
        },
    },
    watch: {
        visibleGalleries: {
            immediate: true,
            handler(newVal) {
                const columnCount = window.innerWidth >= 1280 ? 5 : window.innerWidth >= 768 ? 2 : 2
                this.galleryCol = this.groupItemByColumn(newVal, columnCount)
            },
        },
    },
    mounted() {
        window.addEventListener('resize', this.handleResize)
        this.handleResize()
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.handleResize)
    },
    methods: {
        shuffleArray(array) {
            let shuffled = array.slice()
            for (let i = shuffled.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1))
                ;[shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]]
            }
            return shuffled
        },
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
            const columnCount = window.innerWidth >= 1280 ? 5 : window.innerWidth >= 768 ? 2 : 2
            this.galleryCol = this.groupItemByColumn(this.visibleGalleries, columnCount)
        },
        selectCategory(category) {
            this.selectedCategory = category
            this.displayCount = 20
        },
        loadMore() {
            this.displayCount += 10
        },
    },
}
</script>
