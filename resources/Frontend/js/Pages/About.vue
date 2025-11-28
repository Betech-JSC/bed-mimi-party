<template>
    <main class="bg-black">
        <section class="relative pt-12 md:pb-[80px] pb-[64px] xl:pb-[120px]">
            <div class="absolute inset-0">
                <JPicture
                    src="/assets/images/about/bg-about.jpg"
                    alt="background about"
                    class="w-full h-full object-cover"
                />
            </div>
            <div class="relative">
                <div class="container md:space-y-[80px] space-y-[64px] xl:space-y-[120px]">
                    <div
                        class="max-w-[660px] w-full mx-auto text-white md:space-y-[80px] space-y-[28px] xl:space-y-[120px]"
                    >
                        <div class="flex items-center justify-center">
                            <h2 class="display-2">{{ tt('About') }}</h2>
                            <div class="max-w-[110px] md:max-w-[150px] xl:max-w-[200px]">
                                <JPicture
                                    src="/assets/images/home/image-90s.png"
                                    alt="image 90s"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                        </div>
                        <div class="max-md:text-[12px] title-2 !font-sans text-center">
                            <div v-html="$page.props.global.the_about_90s_content"></div>
                        </div>
                        <div class="lg:hidden max-md:mt-4">
                            <JPicture
                                src="/assets/images/about/image-about.jpg"
                                alt="image about"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                    <div class="flex lg:flex-row flex-col items-start md:gap-[64px] gap-[64px] xl:gap-[120px]">
                        <div
                            class="flex-shrink-0 max-w-full lg:max-w-[424px] xl:py-10 w-full flex items-center justify-center"
                        >
                            <div class="md:space-y-12 space-y-8 xl:space-y-16">
                                <div class="md:space-y-4 space-y-3 xl:space-y-5 text-white">
                                    <div class="headline-3 uppercase">{{ tt('The Venue') }}</div>
                                    <div class="body-2 md:space-y-3 space-y-2 xl:space-y-4">
                                        <div v-html="$page.props.global.the_venue_content"></div>
                                    </div>
                                </div>
                                <div class="md:space-y-4 space-y-3 xl:space-y-5 text-white">
                                    <div class="headline-3 uppercase">{{ tt('Experience') }}</div>
                                    <div class="body-2 md:space-y-3 space-y-2 xl:space-y-4">
                                        <div v-html="$page.props.global.experience_content"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <JPicture
                                src="/assets/images/about/image-about.jpg"
                                alt="image about"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pb-12 md:pb-[80px] xl:pb-[120px]">
            <div class="container">
                <VideoAbout
                    videoSrc="https://drive.google.com/file/d/1MPVhg_UnCPNqxHvMf44M9aSfrNiWRJ9p/view?usp=sharing"
                    poster="/placeholder-col.png"
                    :autoplay="false"
                />

                <!-- <div class="grid md:grid-cols-3 gap-3 md:gap-5 xl:gap-[30px]"> -->
                <!-- <div v-for="(itemVideo, indexVideo) in videos" :key="indexVideo">
                        <VideoAbout :videoSrc="itemVideo.link" poster="/placeholder-col.png" :autoplay="false" />
                    </div> -->
                <!-- </div> -->
            </div>
        </section>
        <section class="md:pb-16 pb-12 xl:pb-20 relative overflow-hidden">
            <div class="circle-orange right-[-340px] top-[180px]"></div>
            <div class="relative">
                <div class="container md:space-y-[80px] space-y-[64px] xl:space-y-[120px]">
                    <div
                        v-for="(itemRoom, indexRoom) in items"
                        :key="indexRoom"
                        class="grid md:grid-cols-2 gap-4 md:gap-5 xl:gap-[120px]"
                    >
                        <div
                            class="flex items-center justify-center"
                            :class="indexRoom % 2 !== 0 ? 'order-2 md:order-1' : 'order-2'"
                        >
                            <div class="text-center text-white space-y-5">
                                <div class="display-3">{{ itemRoom.title }}</div>
                                <div class="body-2" v-html="itemRoom.description"></div>
                            </div>
                        </div>
                        <div :class="indexRoom % 2 !== 0 ? 'order-1 md:order-2' : 'order-1'">
                            <JPicture
                                :src="itemRoom.image"
                                :alt="itemRoom.title || 'image'"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
import Star from '@/Components/Icons/Star.vue'
import BannerIcon from '@/Components/BannerIcon.vue'

export default {
    props: ['posts'],
    components: {
        Star,
        BannerIcon,
    },
    data() {
        return {
            videos: [
                {
                    link: 'https://drive.google.com/file/d/1aCTWCSKx5Yplz6pNZFNfEshcOXwTfogL/view?usp=sharing',
                },
                {
                    link: 'https://drive.google.com/file/d/1UMWdrgUo4ydnOy94W4KCueTFEDJjg_XM/view?usp=sharing',
                },
                {
                    link: 'https://drive.google.com/file/d/1MPVhg_UnCPNqxHvMf44M9aSfrNiWRJ9p/view?usp=sharing',
                },
            ],
            items: [
                {
                    image: this.tt('/assets/images/about/image-private-room.jpg'),
                    title: this.tt('PRIVATE Room'),
                    description: this.$page.props.global.private_room_content,
                },
                {
                    image: this.tt('/assets/images/about/image-special-show.jpg'),
                    title: this.tt('SPECIAL Shows'),
                    description: this.$page.props.global.special_show_content,
                },
            ],
        }
    },
}
</script>
