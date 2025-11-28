<template>
    <footer>
        <div class="relative pt-6 pb-8 bg-black">
            <div class="container">
            <div class="flex max-lg:flex-wrap items-start justify-between gap-10 xl:gap-[89px] md:pr-[52px]">
                <div class="py-4 lg:py-8 space-y-3 lg:space-y-[18px] max-lg:mx-auto">
                    <div class="max-w-[200px] max-h-[133px]">
                        <Link :href="route('home')">
                            <JPicture src="/assets/images/logo.png" alt="logo" class="w-full h-full" />
                        </Link>
                    </div>
                    <div class="flex items-center justify-center gap-4">
                        <div v-for="(itemSocial, indexSocial) in socials" :key="indexSocial">
                            <JPicture :src="itemSocial.icon" :alt="itemSocial.alt" class="w-full h-full object-cover" />
                        </div>
                    </div>
                </div>
                <div class="space-y-[14px] max-lg:w-full xl:w-[450px]">
                    <div
                        v-for="(itemInfo, indexInfo) in infos"
                        :key="indexInfo"
                        class="flex items-start gap-3 xl:gap-4"
                    >
                        <div
                            class="max-w-[130px] md:max-w-[160px] w-full text-white/60 body-3 uppercase !font-display flex-shrink-0 mt-1"
                        >
                            {{ itemInfo.title }}
                        </div>
                        <div class="flex-1 w-full body-1 text-white lg:hover:text-primary duration-300 ease-in-out">
                            <a
                                :href="itemInfo.href"
                                :target="itemInfo.target"
                                rel="noopener noreferrer nofollow"
                                v-html="itemInfo.content"
                            >
                            </a>
                        </div>
                    </div>
                </div>
                <div class="max-w-full lg:max-w-[300px] xl:max-w-[454px] w-full relative">
                    <!-- <VideoFooter videoSrc="/assets/video/video-hero.mp4" poster="/assets/placeholder.jpg" /> -->
                    <iframe
                        width="100%"
                        height="252"
                        style="border: 0"
                        loading="lazy"
                        allowfullscreen
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62714.704!2d106.6910905!3d10.7714301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f00505a9f23%3A0xb2b25e0376cd3dde!2s90S%20HOUSE%20-%20PRIVATE%20LOUNGE%20BAR!5e1!3m2!1svi!2s!4v1696939200000">                    >
                    </iframe>
                </div>
            </div>
        </div>
        </div>
        <div>
            <div class="container">
                <div class="flex justify-between space-x-4 items-center py-2.5 body-3 xl:px-6">
                    <div>
                        © {{ currentYear }} 90S HOUSE. - Design by <span><a href="https://betech-digital.com" target="_blank" rel="noopener noreferrer nofollow">Betech</a></span>
                    </div>
                    <div>{{ tt('All rights reserved.') }}</div>
                </div>
            </div>
                
        </div>
    </footer>
</template>
<script>
export default {
    data() {
        return {
            infos: [
                {
                    title: this.tt('Address'),
                    content: this.$page.props.global.address ?? '',
                    href: this.$page.props.global.link_address ?? '',
                    target: '_blank',
                },
                {
                    title: this.tt('Phone'),
                    content: this.$page.props.global.general_phone ?? '',
                    href: `tel:${this.$page.props.global.general_phone}`,
                    target: '_self',
                },
                {
                    title: this.tt('Mail-Marketing'),
                    content: this.$page.props.global.mail_marketing ?? '',
                    href: `mailto:${this.$page.props.global.mail_marketing}`,
                    target: '_self',
                },
                {
                    title: this.tt('Mail-Sale'),
                    content: this.$page.props.global.mail_sale ?? '',
                    href: `mailto:${this.$page.props.global.mail_sale}`,
                    target: '_self',
                },
                {
                    title: this.tt('Website'),
                    content: this.tt('90shouse.vn'),
                    href: this.tt('https://90shouse.vn'),
                    target: '_blank',
                },
            ],
            socials: [
                {
                    link: this.$page.props.global.general_instagram_link ?? '',
                    icon: '/assets/svg/social/instagram.svg',
                    alt: 'instagram icon',
                },
                {
                    link: this.$page.props.global.general_fb_link ?? '',
                    icon: '/assets/svg/social/facebook.svg',
                    alt: 'fb icon',
                },
                {
                    link: this.$page.props.global.general_tiktok_link ?? '',
                    icon: '/assets/svg/social/tiktok.svg',
                    alt: 'tiktok icon',
                },
                {
                    link: this.$page.props.global.general_zalo_link ?? '',
                    icon: '/assets/svg/social/zalo.svg',
                    alt: 'zalo icon',
                },
            ],
            currentYear: '',
        }
    },
    computed: {
        categories() {
            return this.$page.props.data.footer_categories || []
        },
        products() {
            return this.$page.props.data.footer_products || []
        },
        policies() {
            return this.$page.props.data.policies || []
        },
        global() {
            return this.$page.props.data.global
        },
    },
    created: function () {
        this.currentYear = new Date().getFullYear()
    },
}
</script>
<style lang="scss" scoped>
.bg-footer {
    background: url('/assets/images/footer/background-mobile.webp');
    @apply bg-cover bg-no-repeat;
}
@media screen and (min-width: 768px) {
    .bg-footer {
        background: url('/assets/images/footer/background.webp');
        @apply bg-cover bg-no-repeat;
    }
}
</style>
