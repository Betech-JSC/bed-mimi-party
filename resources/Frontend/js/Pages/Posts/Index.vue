<template>
    <main class="bg-primary-900">
        <section class="relative z-10 h-[500px] xl:h-[720px]">
            <div class="absolute inset-0">
                <JPicture
                    src="/assets/images/demo/image-blog-demo.jpg"
                    loading="eager"
                    class="object-fit h-full w-full object-cover"
                    alt="image demo"
                />
            </div>
            <div class="absolute inset-0 w-full h-full bg-[#010A1C] bg-opacity-[56%]"></div>
            <div class="relative pb-4 md:pb-5 xl:pb-6 h-full">
                <div class="container flex items-end mt-auto h-full">
                    <div class="text-white space-y-4 xl:space-y-5">
                        <h3 class="display-3 font-extrabold uppercase line-clamp-2">
                            Tổ chức sự kiện được hiểu một cách đơn giản là quá trình lên ý tưởng sự kiện
                        </h3>
                        <div class="flex items-center gap-3">
                            <div class="title-2">Tên tác giả</div>
                            <div>|</div>
                            <div class="body-1">20pm 20.8.2025</div>
                        </div>
                        <div class="title-2 !font-normal line-clamp-2 md:line-clamp-3">
                            Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác
                            và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết
                            với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần
                            chuẩn bị những ý tưởng sáng tạo, độc đáo.
                        </div>
                        <button class="btn btn-primary">Xem thêm</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="md:py-16 py-12 xl:py-20">
            <div class="container">
                <div class="grid md:grid-cols-2 grid-cols-1 lg:grid-cols-3 md:gap-6 gap-4 xl:gap-8">
                    <CardPost v-for="(itemPost, indexPost) in posts" :key="indexPost" :item="itemPost" />
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import CardPost from '@/Components/Card/CardPost.vue'

export default {
    components: { CardPost },
    props: ['categories', 'posts', 'banner'],
    data() {
        return {
            posts: [
                {
                    image: {
                        url: '/assets/images/demo/image-event-1.jpg',
                        alt: 'image demo',
                    },
                    created_at: '20pm 20.8.2025',
                    title: 'Tổ chức sự kiện được hiểu một cách đơn giản là quá trình lên ý tưởng sự kiện, chuẩn bị hậu cần, thực hiện và giám sát sự kiện',
                    slug: 'demo-blog-1',
                    description:
                        'Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo.',
                    category: {
                        title: 'Tin tức',
                    },
                },
                {
                    image: {
                        url: '/assets/images/demo/image-event-1.jpg',
                        alt: 'image demo',
                    },
                    created_at: '20pm 20.8.2025',
                    title: 'Top 10+ Ý tưởng Gala Dinner ấn tượng và độc đáo nhất',
                    slug: 'demo-blog-1',
                    description:
                        'Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo.',
                    category: {
                        title: 'Tin tức',
                    },
                },
                {
                    image: {
                        url: '/assets/images/demo/image-event-1.jpg',
                        alt: 'image demo',
                    },
                    created_at: '20pm 20.8.2025',
                    title: 'Top 10+ Ý tưởng Gala Dinner ấn tượng và độc đáo nhất',
                    slug: 'demo-blog-1',
                    description:
                        'Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo.',
                    category: {
                        title: 'Tin tức',
                    },
                },
                {
                    image: {
                        url: '/assets/images/demo/image-event-1.jpg',
                        alt: 'image demo',
                    },
                    created_at: '20pm 20.8.2025',
                    title: 'Tổ chức sự kiện được hiểu một cách đơn giản là quá trình lên ý tưởng sự kiện, chuẩn bị hậu cần, thực hiện và giám sát sự kiện',
                    slug: 'demo-blog-1',
                    description:
                        'Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo.',
                    category: {
                        title: 'Tin tức',
                    },
                },
                {
                    image: {
                        url: '/assets/images/demo/image-event-1.jpg',
                        alt: 'image demo',
                    },
                    created_at: '20pm 20.8.2025',
                    title: 'Top 10+ Ý tưởng Gala Dinner ấn tượng và độc đáo nhất',
                    slug: 'demo-blog-1',
                    description:
                        'Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo.',
                    category: {
                        title: 'Tin tức',
                    },
                },
                {
                    image: {
                        url: '/assets/images/demo/image-event-1.jpg',
                        alt: 'image demo',
                    },
                    created_at: '20pm 20.8.2025',
                    title: 'Top 10+ Ý tưởng Gala Dinner ấn tượng và độc đáo nhất',
                    slug: 'demo-blog-1',
                    description:
                        'Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo.',
                    category: {
                        title: 'Tin tức',
                    },
                },
                {
                    image: {
                        url: '/assets/images/demo/image-event-1.jpg',
                        alt: 'image demo',
                    },
                    created_at: '20pm 20.8.2025',
                    title: 'Tổ chức sự kiện được hiểu một cách đơn giản là quá trình lên ý tưởng sự kiện, chuẩn bị hậu cần, thực hiện và giám sát sự kiện',
                    slug: 'demo-blog-1',
                    description:
                        'Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo.',
                    category: {
                        title: 'Tin tức',
                    },
                },
                {
                    image: {
                        url: '/assets/images/demo/image-event-1.jpg',
                        alt: 'image demo',
                    },
                    created_at: '20pm 20.8.2025',
                    title: 'Top 10+ Ý tưởng Gala Dinner ấn tượng và độc đáo nhất',
                    slug: 'demo-blog-1',
                    description:
                        'Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo.',
                    category: {
                        title: 'Tin tức',
                    },
                },
                {
                    image: {
                        url: '/assets/images/demo/image-event-1.jpg',
                        alt: 'image demo',
                    },
                    created_at: '20pm 20.8.2025',
                    title: 'Top 10+ Ý tưởng Gala Dinner ấn tượng và độc đáo nhất',
                    slug: 'demo-blog-1',
                    description:
                        'Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo.',
                    category: {
                        title: 'Tin tức',
                    },
                },
            ],
            post: {
                content: `
                    <h2>Ứng dụng công nghệ</h2>
                    <p>Khái niệm "công nghệ" không chỉ được giải nghĩa ở những liệt kê cố định, vì thế không thể "tái sử dụng" lại dàn bài của một bản kế hoạch cũ nào đó mà không có sự cập nhập, chỉnh sửa mới. Nếu VR (Virtual Reality- thực tế ảo) đã không còn xa lạ trong các sự kiện, thì AR (Augmented Reality - thực tế tăng cường) - tương tác kết hợp thực và ảo, khai phóng không gian hiện thực đang được quan tâm.</p>
                    <p>Khái niệm "công nghệ" không chỉ được giải nghĩa ở những liệt kê cố định, vì thế không thể "tái sử dụng" lại dàn bài của một bản kế hoạch cũ nào đó mà không có sự cập nhập, chỉnh sửa mới. Nếu VR (Virtual Reality- thực tế ảo) đã không còn xa lạ trong các sự kiện, thì AR (Augmented Reality - thực tế tăng cường) - tương tác kết hợp thực và ảo, khai phóng không gian hiện thực đang được quan tâm.</p>
                    <img src="/assets/images/demo/image-blog-demo.jpg" alt="image demo" />
                    <i>Ghi chú hình ảnh: Một sự kiện thành công được kết hợp bởi rất nhiều yếu tố, trong sự suy xét thấu đáo của nhà tổ chức, cùng sự phối hợp của địa điểm tổ chức nền tảng.</i>
                    <h2>Yếu tố giải trí</h2>
                    <p>Không chỉ là nét điểm xuyến phụ họa cho dòng chương trình, các yếu tố giải trí còn được mượn làm công cụ chính để quảng bá trong giai đoạn trước khi diễn ra sự kiện, lẫn gia tăng tương tác, đưa sản phẩm, dịch vụ, thông điệp đến gần hơn với người tham dự.</p>
                    <p>Màn trình diễn của những ngôi sao, biến sân khấu thành một sàn khiêu vũ khởi động trước hội nghị, những cái bắt tay phối hợp với đối tác, thương hiệu khác đem đến sự kiện nhiều hoạt động, gian hàng, quà tặng hơn...</p>
                    <img src="/assets/images/demo/image-blog-demo.jpg" alt="image demo" />
                    <i>Ghi chú hình ảnh: Live band chuyên nghiệp</i>
                    <h2>Yếu tố giải trí</h2>
                    <p>Không chỉ là nét điểm xuyến phụ họa cho dòng chương trình, các yếu tố giải trí còn được mượn làm công cụ chính để quảng bá trong giai đoạn trước khi diễn ra sự kiện, lẫn gia tăng tương tác, đưa sản phẩm, dịch vụ, thông điệp đến gần hơn với người tham dự.</p>
                    <p>Màn trình diễn của những ngôi sao, biến sân khấu thành một sàn khiêu vũ khởi động trước hội nghị, những cái bắt tay phối hợp với đối tác, thương hiệu khác đem đến sự kiện nhiều hoạt động, gian hàng, quà tặng hơn...</p>
                `,
            },
        }
    },
}
</script>
