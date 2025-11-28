<template>
    <main class="bg-primary-25">
        <section>
            <div class="h-[436px] relative bg-primary-700">
                <div class="relative h-full">
                    <div class="container h-full flex items-center justify-center">
                        <div class="grid grid-cols-12 gap-4 md:gap-6 xl:gap-8">
                            <div
                                class="col-span-full md:col-span-10 md:col-start-2 space-y-5 flex flex-col justify-center items-center"
                            >
                                <JamBreadcrumb :isWhite="true" :items="breadcrumbs" />
                                <div class="space-y-3">
                                    <h1
                                        class="text-primary-100 display-2 inline-block uppercase text-center"
                                        v-html="post.title"
                                    ></h1>
                                    <div class="max-w-[254px] w-full mx-auto text-primary-100 flex items-center gap-3">
                                        <div class="w-full h-px bg-primary-100"></div>
                                        <LogoSymbol class="flex-shrink-0" />
                                        <div class="w-full h-px bg-primary-100"></div>
                                    </div>
                                    <div
                                        class="body-0 text-center mx-auto w-full max-w-[700px] !font-sans !font-normal text-primary-100"
                                    >
                                        {{ post.description }}
                                    </div>
                                    <div class="body-1 text-primary-100/70 text-center">{{ post.published_at }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-12">
            <div class="container">
                <div class="max-w-[800px] w-full mx-auto space-y-8">
                    <JPicture
                        :src="post.image.url"
                        alt="image sign 1"
                        wrapperClass="picture-cover"
                        class="w-full h-full object-cover"
                    />
                    <div class="prose prose-blog" v-html="post.content"></div>

                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-end space-x-[16px]">
                            <div class="flex items-center max-md:justify-end">
                                <div class="relative">
                                    <div
                                        @click="copyLink()"
                                        class="text-gray-300 duration-150 cursor-pointer hover:text-green-500"
                                    >
                                        <Share />
                                    </div>
                                    <input id="input-copy" type="hidden" />
                                    <div
                                        class="absolute lg:top-[110%] top-[120%] bg-primary-800 rounded-lg text-white duration-300 py-[4px] px-[12px] w-max lg:left-[40%] left-[-200%]"
                                        :class="copySuccess ? 'opacity-100' : 'opacity-0'"
                                    >
                                        {{ tt('Đã copy link') }}
                                    </div>
                                </div>
                            </div>
                            <a :href="twitterUrl" target="_blank" class="inline-block">
                                <Twitter />
                            </a>
                            <a :href="facebookUrl" target="_blank" class="inline-block">
                                <Facebook />
                            </a>
                            <a :href="instagramUrl" target="_blank" class="inline-block">
                                <LinkedIn />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <SectionRelatedPosts :items="related_posts" />
    </main>
</template>

<script>
import Facebook from '@/Components/Icon/Facebook.vue'
import Twitter from '@/Components/Icon/Twitter.vue'
import LinkedIn from '@/Components/Icon/LinkedIn.vue'
import Share from '@/Components/Icon/Share.vue'
export default {
    components: { Facebook, Share, Twitter, LinkedIn },
    props: ['post', 'related_posts', 'breadcrumbs'],
    data() {
        return {
            facebookUrl: null,
            copySuccess: false,
        }
    },
    mounted() {
        this.facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${window.location.href}`
        this.instagramUrl = `http://twitter.com/share?text=${window.location.href}`
        this.twitterUrl = `http://twitter.com/share?text=${window.location.href}`
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
    },
}
</script>

<style></style>
