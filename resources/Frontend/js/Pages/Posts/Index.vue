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
        <!-- {{ posts }} -->
        <section class="md:py-16 py-12 xl:py-20">
            <div class="container">
                <div class="grid md:grid-cols-2 grid-cols-1 lg:grid-cols-3 md:gap-6 gap-4 xl:gap-8">
                    <CardPost v-for="(itemPost, indexPost) in posts.data" :key="indexPost" :item="itemPost" />
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
}
</script>
