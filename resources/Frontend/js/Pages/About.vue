<template>
    <main class="bg-black">
        <BannerImage :banner="banner" classBanner="md:h-[400px] h-[350px] xl:h-[574px]" />
        <SectionMissionValue :values="values" />
        <section class="md:py-16 py-12 xl:py-20 relative">
            <div class="absolute inset-0">
                <JPicture src="/assets/images/about/bg-commit.jpg" alt="background commit" class="w-full h-full" />
            </div>
            <div class="relative">
                <div class="container md:space-y-[80px] space-y-16 xl:space-y-[120px]">
                    <div class="md:space-y-6 space-y-4 xl:space-y-8">
                        <div class="space-y-3 text-center">
                            <h2 class="title-linear display-2 uppercase font-extrabold">
                                {{ $page.props.global.section_commit_title ?? 'Chúng tôi cam kết' }}
                            </h2>
                            <div class="body-1 text-white" v-html="$page.props.global.section_commit_description ??
                                `Tại MIMI PARTY, mỗi buổi tiệc không chỉ là một dự án – mà là lời hứa về sự hoàn hảo trong từng khoảnh khắc. <br /> Chúng tôi cam kết mang đến trải nghiệm trọn vẹn, cảm xúc thật và dịch vụ đẳng cấp, từ khâu sáng tạo ý tưởng đến giây phút cuối cùng của bữa tiệc`
                                "></div>
                        </div>
                        <div class="grid md:grid-cols-4">
                            <div v-for="(itemCommit, indexCommit) in commits" :key="indexCommit"
                                class="md:space-y-8 space-y-6 xl:space-y-12 lg:hover:bg-white/5 border border-transparent lg:hover:border-white/50 duration-300 ease-in-out md:p-4 p-3 xl:py-8 xl:px-6 text-center">
                                <div class="w-12 h-12 md:h-[72px] md:w-[72px] mx-auto">
                                    <JPicture :src="itemCommit.icon" :alt="itemCommit.title"
                                        class="w-full h-full mix-blend-plus-lighter" />
                                </div>
                                <div class="space-y-3">
                                    <h3 class="title-2 font-bold text-white">{{ itemCommit.title }}</h3>
                                    <div class="title-4 text-white" v-html="itemCommit.description"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex lg:flex-row flex-col items-start gap-6 md:gap-8 xl:gap-12">
                        <div class="max-w-[282px] w-full">
                            <h2 class="title-linear display-3 uppercase font-extrabold">Vì sao chọn Mini Party?</h2>
                        </div>
                        <div class="flex-1 w-full">
                            <div v-for="(itemReason, indexReason) in reasons" :key="indexReason"
                                class="space-y-3 text-white pt-4 md:pt-8 pb-4 md:px-6 flex items-start gap-3 md:gap-6 lg:hover:bg-white/5 border border-transparent lg:hover:border-white/50 duration-300 ease-in-out">
                                <div class="w-12 h-12 md:w-[72px] md:h-[72px] max-md:mt-3">
                                    <JPicture :src="itemReason.image" :alt="itemReason.title"
                                        class="w-full h-full mix-blend-plus-lighter" />
                                </div>
                                <div class="space-y-3 flex-1 w-full">
                                    <div class="title-2">{{ itemReason.title }}</div>
                                    <div class="body-2" v-html="itemReason.description"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
import SectionMissionValue from '@/Components/SectionMissionValue.vue'

export default {
    props: ['posts'],
    components: { SectionMissionValue },
    data() {
        return {
            banner: {
                image: '/assets/images/about/bg-banner.jpg',
            },
            values: [
                {
                    image: {
                        url: '/assets/images/home/image-value-1.png',
                        alt: 'image value 1',
                    },
                    title: this.$page.props.global.section_service_card_1_title,
                    description: this.$page.props.global.section_service_card_1_description,
                },
                {
                    image: {
                        url: '/assets/images/home/image-value-2.png',
                        alt: 'image value 2',
                    },
                    title: this.$page.props.global.section_service_card_2_title,
                    description: this.$page.props.global.section_service_card_2_description,
                },
                {
                    image: {
                        url: '/assets/images/home/image-value-3.png',
                        alt: 'image value 3',
                    },
                    title: this.$page.props.global.section_service_card_3_title,
                    description: this.$page.props.global.section_service_card_3_description,
                },
            ],
            commits: [
                {
                    icon: '/assets/images/about/image-commit-1.png',
                    title: this.$page.props.global.section_commit_card_1_title,
                    description: this.$page.props.global.section_commit_card_1_description,
                },
                {
                    icon: '/assets/images/about/image-commit-2.png',
                    title: this.$page.props.global.section_commit_card_2_title,
                    description:
                        this.$page.props.global.section_commit_card_2_description,
                },
                {
                    icon: '/assets/images/about/image-commit-3.png',
                    title:
                        this.$page.props.global.section_commit_card_3_title ?? 'Đúng hẹn – Đúng chuẩn – Đúng cảm xúc',
                    description:
                        this.$page.props.global.section_commit_card_3_description ??
                        'Từ khâu setup, vận hành đến biểu diễn, chúng tôi cam kết mang lại sự trọn vẹn và đúng kỳ vọng đã đặt ra.',
                },
                {
                    icon: '/assets/images/about/image-commit-4.png',
                    title: this.$page.props.global.section_commit_card_4_title ?? 'Cá nhân hoá trải nghiệm',
                    description:
                        this.$page.props.global.section_commit_card_4_description ??
                        'Mỗi bữa tiệc mang dấu ấn riêng, được thiết kế theo gu thẩm mỹ, tính cách và thông điệp của khách hàng.',
                },
            ],
            reasons: [
                {
                    image: '/assets/images/about/image-m.png',
                    title: this.$page.props.global.section_reasons_card_1_title,
                    description: this.$page.props.global.section_reasons_card_1_description,
                {
                    image: '/assets/images/about/image-i.png',
                    title: this.$page.props.global.section_reasons_card_2_title,
                    description: this.$page.props.global.section_reasons_card_2_description,
                },
                {
                    image: '/assets/images/about/image-m.png',
                    title: this.$page.props.global.section_reasons_card_3_title,
                    description: this.$page.props.global.section_reasons_card_3_description,
                },
                {
                    image: '/assets/images/about/image-i.png',
                    title: this.$page.props.global.section_reasons_card_4_title,
                    description: this.$page.props.global.section_reasons_card_4_description,
                },
            ],
        }
    },
}
</script>
