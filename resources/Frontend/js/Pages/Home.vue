<template>
    <main class="bg-primary-900 overflow-hidden">
        <SectionHero />
        <SectionService :showButton="true" :services="services" />
        <Marquee :marquee="marquees" />
        <SectionMissionValue :values="values" />
        <div class="bg-dark">
            <MarqueeWhite :marquee="marquees" />
            <SectionProject :projects="projects" />
            <Marquee :marquee="marquees" />
            <SectionPartner :partners="partners" />
            <SectionPost :posts="posts" />
        </div>
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
    },
    props: ['posts', 'services', 'projects'],
    data() {
        return {
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
                        Xây dựng hệ sinh thái dịch vụ tiệc “All in One”: từ ý tưởng, thiết kế, trang trí, âm nhạc, biểu diễn cho đến vận hành. Đặt Minh bạch – Chất lượng – Riêng tư làm nền tảng trong mọi hoạt động.  Không ngừng hoàn thiện quy trình để mang đến sự hài lòng tuyệt đối – nơi tiêu chuẩn duy nhất mà chúng tôi hướng đến, chính là tiêu chuẩn của khách hàng.
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
}
</script>
