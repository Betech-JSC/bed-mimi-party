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
                            <h2 class="title-linear display-2 uppercase font-extrabold">Chúng tôi cam kết</h2>
                            <div class="body-1 text-white" >
                                Tại MIMI PARTY, mỗi buổi tiệc không chỉ là một dự án – mà là lời hứa về sự hoàn hảo
                                trong từng khoảnh khắc. <br />
                                Chúng tôi cam kết mang đến trải nghiệm trọn vẹn, cảm xúc thật và dịch vụ đẳng cấp, từ
                                khâu sáng tạo ý tưởng đến giây phút cuối cùng của bữa tiệc
                            </div>
                        </div>
                        <div class="grid md:grid-cols-4">
                            <div
                                v-for="(itemCommit, indexCommit) in commits"
                                :key="indexCommit"
                                class="md:space-y-8 space-y-6 xl:space-y-12 lg:hover:bg-white/5 border border-transparent lg:hover:border-white/50 duration-300 ease-in-out md:p-4 p-3 xl:py-8 xl:px-6 text-center"
                            >
                                <div class="w-12 h-12 md:h-[72px] md:w-[72px] mx-auto">
                                    <JPicture
                                        :src="itemCommit.icon"
                                        :alt="itemCommit.title"
                                        class="w-full h-full mix-blend-plus-lighter"
                                    />
                                </div>
                                <div class="space-y-3">
                                    <h3 class="title-2 font-bold text-white">{{ itemCommit.title }}</h3>
                                    <div class="title-4 text-white">{{ itemCommit.description }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex lg:flex-row flex-col items-start gap-6 md:gap-8 xl:gap-12">
                        <div class="max-w-[282px] w-full">
                            <h2 class="title-linear display-3 uppercase font-extrabold">Vì sao chọn Mini Party?</h2>
                        </div>
                        <div class="flex-1 w-full">
                            <div
                                v-for="(itemReason, indexReason) in reasons"
                                :key="indexReason"
                                class="space-y-3 text-white pt-4 md:pt-8 pb-4 md:px-6 flex items-start gap-3 md:gap-6 lg:hover:bg-white/5 border border-transparent lg:hover:border-white/50 duration-300 ease-in-out"
                            >
                                <div class="w-12 h-12 md:w-[72px] md:h-[72px] max-md:mt-3">
                                    <JPicture
                                        :src="itemReason.image"
                                        :alt="itemReason.title"
                                        class="w-full h-full mix-blend-plus-lighter"
                                    />
                                </div>
                                <div class="space-y-3 flex-1 w-full">
                                    <div class="title-2">{{ itemReason.title }}</div>
                                    <div class="body-2">{{ itemReason.description }}</div>
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
            commits: [
                {
                    icon: '/assets/images/about/image-commit-1.png',
                    title: 'Chất lượng & Sự chỉn chu',
                    description:
                        'Mỗi hạng mục – từ décor, biểu diễn đến kỹ thuật – đều được kiểm soát tỉ mỉ, đảm bảo chuẩn mực cao nhất trong ngành tổ chức tiệc.',
                },
                {
                    icon: '/assets/images/about/image-commit-2.png',
                    title: 'Minh bạch & Uy tín',
                    description:
                        'Mọi chi phí, quy trình và hạng mục đều rõ ràng – giúp khách hàng an tâm và tin tưởng tuyệt đối.',
                },
                {
                    icon: '/assets/images/about/image-commit-3.png',
                    title: 'Đúng hẹn – Đúng chuẩn – Đúng cảm xúc',
                    description:
                        'Từ khâu setup, vận hành đến biểu diễn, chúng tôi cam kết mang lại sự trọn vẹn và đúng kỳ vọng đã đặt ra.',
                },
                {
                    icon: '/assets/images/about/image-commit-4.png',
                    title: 'Cá nhân hoá trải nghiệm',
                    description:
                        'Mỗi bữa tiệc mang dấu ấn riêng, được thiết kế theo gu thẩm mỹ, tính cách và thông điệp của khách hàng.',
                },
            ],
            reasons: [
                {
                    image: '/assets/images/about/image-m.png',
                    title: 'Trọn gói – Đồng bộ – Tiện lợi',
                    description:
                        'Mimi Party mang đến giải pháp tổ chức tiệc toàn diện (All in One) – nơi mọi yếu tố từ décor, biểu diễn, âm nhạc đến hình ảnh đều được kết nối trong một tổng thể thống nhất. Chúng tôi không chỉ giúp khách hàng tiết kiệm thời gian và chi phí, mà còn biến quá trình chuẩn bị tiệc thành một trải nghiệm đầy cảm hứng.',
                },
                {
                    image: '/assets/images/about/image-i.png',
                    title: 'Đội ngũ chuyên nghiệp & tận tâm',
                    description:
                        'Mỗi thành viên của Mimi Party đều có kinh nghiệm sâu trong lĩnh vực décor, performance và event management. Chúng tôi làm việc bằng trách nhiệm, đam mê và sự chỉn chu, để mọi khoảnh khắc trong buổi tiệc đều diễn ra hoàn hảo – đúng chuẩn mực mà khách hàng mong đợi.',
                },
                {
                    image: '/assets/images/about/image-m.png',
                    title: 'Kinh nghiệm đa dạng',
                    description:
                        'Chúng tôi đã thực hiện nhiều loại hình tiệc: cá nhân, doanh nghiệp, thương hiệu, nhà hàng – lounge – KTV VIP. Chính kinh nghiệm thực chiến này giúp Mimi Party luôn linh hoạt sáng tạo concept và giải pháp phù hợp với từng ngân sách, không gian và đối tượng khách hàng.',
                },
                {
                    image: '/assets/images/about/image-i.png',
                    title: 'Quản lý & Giám sát chuyên nghiệp',
                    description:
                        'Không chỉ lên ý tưởng, chúng tôi đi cùng khách hàng đến phút cuối của buổi tiệc. Từ setup, vận hành, điều phối nhân sự, kiểm soát tiến độ đến tổng kết – mọi quy trình đều được giám sát chặt chẽ để đảm bảo một sự kiện trọn vẹn, trơn tru và đẳng cấp.',
                },
            ],
        }
    },
}
</script>
