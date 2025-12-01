<template>
    <main class="bg-primary-900">
        <BannerImage :banner="banner" classBanner="md:h-[400px] h-[350px] xl:h-[574px]" />
        <section class="py-[60px]">
            <div class="container space-y-10">
                <h2 class="title-linear display-2 uppercase font-extrabold text-center">Dự án</h2>
                <div v-if="projects.data && projects.data.length > 0" class="grid md:grid-cols-2">
                    <div
                        v-for="(itemProject, indexProject) in projects.data"
                        :key="indexProject"
                        class="border-b-8 border-primary-500 relative aspect-w-2 aspect-h-1 cursor-pointer"
                        @click="openModal(indexProject)"
                    >
                        <div class="absolute inset-0 w-full h-full">
                            <JPicture
                                :src="itemProject.image?.url || '/assets/images/projects/bg-banner.jpg'"
                                class="w-full h-full object-cover"
                                :alt="itemProject.image?.alt || 'Project image'"
                            />
                        </div>
                        <div class="bg-overlay absolute inset-0"></div>
                        <div class="absolute top-1/2 -translate-y-1/2 h-auto px-3 md:px-8 max-w-[280px] w-full space-y-2 md:space-y-4 text-white">
                            <h3 class="title-2 uppercase font-bold">
                                {{ itemProject.title }}
                            </h3>
                            <div class="body-1">
                                {{ itemProject.description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <div
            v-if="isModalOpen && selectedItem"
            class="fixed inset-0 bg-[#000E27] bg-opacity-[63%] flex items-center justify-center z-[9999] p-5"
            @click.self="closeModal"
        >
            <div
                class="relative max-w-[90vw] w-full max-h-[90vh] flex flex-col border border-white/20 bg-linear-modal md:p-6 p-3 xl:p-8"
            >
                <button
                    class="absolute -top-14 -right-4 w-10 h-10 rounded-lg bg-white lg:hover:bg-primary-500 lg:hover:text-white duration-300 ease-in-out text-black flex items-center justify-center"
                    @click="closeModal"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="grid grid-cols-12 gap-4 md:gap-6">
                    <div class="col-span-full lg:col-span-7">
                        <div class="modal-body">
                            <Thumbnails :product="modalProduct" />
                        </div>
                    </div>
                    <div class="col-span-full lg:col-span-5 space-y-8">
                        <h3 class="title-linear display-3 uppercase font-extrabold">{{ selectedItem.title }}</h3>
                        <p class="body-2 text-white">{{ selectedItem.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import Thumbnails from '@/Components/Service/Thumbnails.vue';

export default {
    components: { Thumbnails },

    props: ['projects'],
    
    data() {
        return {
            banner: {
                image: '/assets/images/projects/bg-banner.jpg',
            },
            isModalOpen: false,
            selectedItem: null,
            staticImages: [
                { url: '/assets/images/projects/image-static-1.jpg', alt: 'Project Image 1' },
                { url: '/assets/images/projects/image-static-2.jpg', alt: 'Project Image 2' },
                { url: '/assets/images/projects/image-static-3.jpg', alt: 'Project Image 3' },
            ],
        }
    },
    
    computed: {
        modalProduct() {
            if (!this.selectedItem) return { images: [] };
            
            // Nếu selectedItem có images thì dùng images đó
            if (this.selectedItem.images && this.selectedItem.images.length > 0) {
                return {
                    images: this.selectedItem.images
                };
            }
            
            // Nếu không có images, dùng staticImages
            return {
                images: this.staticImages
            };
        }
    },
    
    methods: {
        openModal(index) {
            this.selectedItem = this.projects.data[index];
            this.isModalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeModal() {
            this.isModalOpen = false;
            this.selectedItem = null;
            document.body.style.overflow = '';
        },
    },
    
    beforeDestroy() {
        document.body.style.overflow = '';
    },
}
</script>

<style lang="scss" scoped>
.bg-overlay {
    background: linear-gradient(
        270deg,
        rgba(1, 26, 63, 0) 40.69%,
        rgba(1, 31, 73, 0.88) 63.65%,
        #04214b 71.38%,
        #071e3f 75.49%,
        #040f1e 100%
    );
}

.bg-linear-modal {
    background: linear-gradient(180deg, rgba(189, 189, 189, 0.3) 0%, rgba(52, 51, 51, 0.3) 100%);
}

/* Custom scrollbar cho modal */
.bg-linear-modal::-webkit-scrollbar {
    width: 8px;
}

.bg-linear-modal::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

.bg-linear-modal::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 4px;
}

.bg-linear-modal::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}
</style>
