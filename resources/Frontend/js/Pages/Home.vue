<template>
    <main class="bg-primary-900 overflow-hidden">
        <SectionHero />
        <SectionMissionValue :isHome="true" :values="values" />
        <div class="bg-dark">
            <Marquee :marquee="marquees" />
            <SectionService :showButton="true" :services="services" @open-modal="openModal" />
            <MarqueeWhite :marquee="marquees" />
            <SectionProject :projects="projects" />
            <Marquee :marquee="marquees" />
            <SectionPartner :partners="partners" />
            <SectionPost :posts="posts" />
        </div>

        <!-- Modal -->
            <div v-if="isModalOpen" class="fixed inset-0 bg-[#000E27] bg-opacity-[63%] flex items-center justify-center z-[9999] p-5" @click.self="closeModal">
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
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-full lg:col-span-7">
                        <div class="modal-body">
                            <ThumbnailModal :product="selectedItem" />
                        </div>
                    </div>
                    <div class="col-span-full lg:col-span-5 space-y-8">
                        <h3 class="title-linear display-3 uppercase font-extrabold">{{ selectedItem.title }}</h3>
                        <p class="body-2 text-white">{{ selectedItem.description }}</p>
                    </div>
                </div>
            </div>
        </div>
        </ClientOnly>
    </main>
</template>

<script>
import SectionHero from '@/Components/SectionHero.vue'
import SectionService from '@/Components/SectionService.vue'
import SectionMissionValue from '@/Components/SectionMissionValue.vue'
import SectionProject from '@/Components/SectionProject.vue'
import SectionPartner from '@/Components/SectionPartner.vue'
import SectionPost from '@/Components/SectionPost.vue'
import Marquee from '@/Components/Marquee.vue'
import MarqueeWhite from '@/Components/MarqueeWhite.vue'
import ThumbnailModal from '@/Components/ThumbnailModal.vue'

export default {
    components: {
        SectionHero,
        SectionService,
        SectionMissionValue,
        SectionProject,
        SectionPartner,
        SectionPost,
        Marquee,
        MarqueeWhite,
        ThumbnailModal,
    },
    props: ['posts', 'services', 'projects'],
    data() {
        return {
            isModalOpen: false,
            selectedItem: null,
            marquees: [
                'MIMI PARTY EVENT',
                'DỊCH VỤ GIẢI TRÍ TRỌN GÓI',
                'DECORATION',
                'DANCER/ MÚA NGHỆ THUẬT',
                'DJ/MC',
                'LIVEBAND',
                'CHỤP ẢNH',
            ],
            values: [
                {
                    image: {
                        url: '/assets/images/home/image-value-1.png',
                        alt: 'image value 1',
                    },
                    title: 'Tầm nhìn',
                    description:
                        'MIMI PARTY hướng đến trở thành đơn vị tổ chức tiệc cá nhân và doanh nghiệp hàng đầu, nơi mỗi sự kiện không chỉ là một buổi tiệc – mà là một trải nghiệm mang dấu ấn riêng biệt, chuẩn mực và đáng nhớ. Chúng tôi không chạy theo xu hướng, chúng tôi tạo nên chuẩn mực mới cho nghệ thuật tổ chức tiệc riêng tư.',
                },
                {
                    image: {
                        url: '/assets/images/home/image-value-2.png',
                        alt: 'image value 2',
                    },
                    title: 'Sứ mệnh',
                    description:
                        'Tại MIMI PARTY, chúng tôi tin rằng mọi khoảnh khắc đáng nhớ đều xứng đáng được tôn vinh bằng sự chỉn chu và cảm xúc chân thật. Bằng đội ngũ sáng tạo và chuyên nghiệp, MIMI PARTY mang đến những bữa tiệc mang đậm cá tính, trọn vẹn trải nghiệm, và phản ánh đúng giá trị của khách hàng – dù đó là cá nhân, doanh nghiệp hay thương hiệu.',
                },
                {
                    image: {
                        url: '/assets/images/home/image-value-3.png',
                        alt: 'image value 3',
                    },
                    title: 'Mục tiêu',
                    description: `
                        Xây dựng hệ sinh thái dịch vụ tiệc "All in One": từ ý tưởng, thiết kế, trang trí, âm nhạc, biểu diễn cho đến vận hành. Đặt Minh bạch – Chất lượng – Riêng tư làm nền tảng trong mọi hoạt động.  Không ngừng hoàn thiện quy trình để mang đến sự hài lòng tuyệt đối – nơi tiêu chuẩn duy nhất mà chúng tôi hướng đến, chính là tiêu chuẩn của khách hàng.
                    `,
                },
            ],
            partners: [
                '/assets/images/demo/image-partner-1.png',
                '/assets/images/demo/image-partner-2.png',
                '/assets/images/demo/image-partner-3.png',
                '/assets/images/demo/image-partner-4.png',
                '/assets/images/demo/image-partner-5.png',
                '/assets/images/demo/image-partner-6.png',
                '/assets/images/demo/image-partner-7.png',
                '/assets/images/demo/image-partner-8.png',
                '/assets/images/demo/image-partner-9.png',
                '/assets/images/demo/image-partner-10.png',
                '/assets/images/demo/image-partner-11.png',
                '/assets/images/demo/image-partner-12.png',
                '/assets/images/demo/image-partner-1.png',
                '/assets/images/demo/image-partner-2.png',
                '/assets/images/demo/image-partner-3.png',
                '/assets/images/demo/image-partner-4.png',
                '/assets/images/demo/image-partner-5.png',
                '/assets/images/demo/image-partner-8.png',
                '/assets/images/demo/image-partner-9.png',
                '/assets/images/demo/image-partner-11.png',
                '/assets/images/demo/image-partner-12.png',
            ],
        }
    },
    methods: {
        openModal(index) {
            if (this.services && this.services[index]) {
                this.selectedItem = this.services[index]
                this.isModalOpen = true
                document.body.style.overflow = 'hidden'
            }
        },
        closeModal() {
            this.isModalOpen = false
            this.selectedItem = null
            document.body.style.overflow = ''
        },
    },
    beforeDestroy() {
        document.body.style.overflow = ''
    },
}
</script>

<style lang="scss" scoped>
.bg-linear-modal {
    background: linear-gradient(180deg, rgba(189, 189, 189, 0.3) 0%, rgba(52, 51, 51, 0.3) 100%);
}
</style>
