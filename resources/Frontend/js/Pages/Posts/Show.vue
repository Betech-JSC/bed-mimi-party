<template>
    <main class="bg-primary-900">
        <section class="md:pt-[150px] pt-[120px] xl:pt-[200px] md:pb-16 pb-12 xl:pb-20">
            <div class="container">
                <div class="grid grid-cols-12 md:gap-6 gap-4 xl:gap-8">
                    <div class="xl:col-span-10 xl:col-start-2 md:space-y-8 space-y-6 xl:space-y-12 col-span-full">
                        <div class="md:space-y-5 space-y-4 xl:space-y-6">
                            <div class="md:flex md:items-center md:justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="body-3 py-1 px-2.5 bg-primary text-white w-max flex items-center justify-center uppercase"
                                    >
                                        <span>Tin tức</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-white">
                                        <span class="title-1">Tên tác giả</span>
                                        <span>|</span>
                                        <span class="button-1 font-semibold">{{ formatDate(post.published_at) }}</span>
                                    </div>
                                </div>
                                <div class="hidden md:flex items-center gap-3">
                                    <span class="title-2 font-bold text-white">Chia sẻ</span>
                                    <div class="flex items-center justify-end gap-4">
                                        <div class="flex items-center max-md:justify-end">
                                            <div class="relative">
                                                <div
                                                    @click="copyLink()"
                                                    class="text-gray-300 duration-150 cursor-pointer lg:hover:text-primary"
                                                >
                                                    <Share />
                                                </div>
                                                <input id="input-copy" type="hidden" />
                                                <div
                                                    class="absolute lg:top-[110%] top-[120%] bg-primary rounded-lg text-white duration-300 py-[4px] px-[12px] w-max lg:left-[40%] left-[-200%]"
                                                    :class="copySuccess ? 'opacity-100' : 'opacity-0'"
                                                >
                                                    {{ tt('Đã copy link') }}
                                                </div>
                                            </div>
                                        </div>
                                        <a
                                            :href="facebookUrl ?? '/'"
                                            target="_blank"
                                            class="inline-block text-gray-300 lg:hover:text-primary duration-150"
                                        >
                                            <Facebook />
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <h1 class="display-3 font-extrabold uppercase text-white">
                                TỔ CHỨC SỰ KIỆN ĐƯỢC HIỆU MỘT CÁCH ĐƠN GIẢN LÀ QUÁ TRÌNH LÊN Ý TƯỞNG SỰ KIỆN
                            </h1>

                            <div class="flex md:hidden items-center gap-3">
                                <span class="title-2 font-bold text-white">Chia sẻ</span>
                                <div class="flex items-center justify-end gap-4">
                                    <div class="flex items-center max-md:justify-end">
                                        <div class="relative">
                                            <div
                                                @click="copyLink()"
                                                class="text-gray-300 duration-150 cursor-pointer lg:hover:text-primary"
                                            >
                                                <Share />
                                            </div>
                                            <input id="input-copy" type="hidden" />
                                            <div
                                                class="absolute lg:top-[110%] top-[120%] bg-primary rounded-lg text-white duration-300 py-[4px] px-[12px] w-max lg:left-[40%] left-[-200%]"
                                                :class="copySuccess ? 'opacity-100' : 'opacity-0'"
                                            >
                                                {{ tt('Đã copy link') }}
                                            </div>
                                        </div>
                                    </div>
                                    <a
                                        :href="facebookUrl ?? '/'"
                                        target="_blank"
                                        class="inline-block text-gray-300 lg:hover:text-primary duration-150"
                                    >
                                        <Facebook />
                                    </a>
                                </div>
                            </div>

                            <p class="title-2 font-bold text-white">
                                Gala dinner là một trong những sự kiện quan trọng được tổ chức để tri ân nhân viên, đối
                                tác và khách hàng. Đây chính là cơ hội để mọi người có thời gian thực sự trò chuyện và
                                gắn kết với nhau. Tuy nhiên, để một gala dinner thực sự nổi bật và để lại dấu ấn khó
                                quên, bạn cần chuẩn bị những ý tưởng sáng tạo, độc đáo...
                            </p>
                        </div>
                        <div class="aspect-w-8 aspect-h-5">
                            <JPicture
                                src="/assets/images/demo/image-blog-demo.jpg"
                                alt="image blog"
                                wrapperClass="picture-cover"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="prose prose-blog" v-html="post.content"></div>
                    </div>
                </div>
            </div>
        </section>

        <section v-if="related_posts && related_posts.length > 0" class="py-12 md:py-16 xl:py-20 border-t border-white">
            <div class="container space-y-5 md:space-y-8 xl:space-y-10">
                <div class="md:flex-row flex-col gap-4 flex justify-center items-center md:justify-between">
                    <h2 class="title-linear display-2 uppercase font-extrabold">Tin tức khác</h2>
                    <button class="btn btn-primary">Xem tất cả</button>
                </div>
                <div class="grid md:grid-cols-2 grid-cols-1 lg:grid-cols-3 md:gap-6 gap-4 xl:gap-8">
                    <CardPost v-for="(itemPost, indexPost) in related_posts" :key="indexPost" :item="itemPost" />
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import Facebook from '@/Components/Icon/Facebook.vue'
import Share from '@/Components/Icon/Share.vue'
import CardPost from '@/Components/Card/CardPost.vue'

export default {
    components: { Facebook, Share, CardPost },
    props: ['post', 'related_posts', 'breadcrumbs'],
    data() {
        return {
            facebookUrl: null,
            copySuccess: false,
        }
    },
    mounted() {
        this.facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${window.location.href}`
        // this.instagramUrl = `http://twitter.com/share?text=${window.location.href}`
        // this.twitterUrl = `http://twitter.com/share?text=${window.location.href}`
        const isScreenPC = window.matchMedia('(min-width: 768px)').matches
        if (isScreenPC) {
            this.isShowTOC = true
        } else {
            this.isShowTOC = false
        }
    },
    methods: {
        copyLink() {
            const input = document.querySelector('#input-copy')
            input.value = window.location.href
            input.setAttribute('type', 'text')
            input.select()
            input.setSelectionRange(0, 99999)
            document.execCommand('copy')
            input.setAttribute('type', 'hidden')
            window.getSelection().removeAllRanges()
            this.copySuccess = true
            setTimeout(() => {
                this.copySuccess = false
            }, 1000)
        },
      formatDate(dateString) {
            // Convert '2025-09-05' to '05.09.2025'
            if (!dateString) return ''
            const [year, month, day] = dateString.split('-')
            return `${day.padStart(2, '0')}.${month.padStart(2, '0')}.${year}`
        },        
    },
}
</script>
