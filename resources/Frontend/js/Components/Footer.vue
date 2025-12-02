<template>
    <footer>
        <div class="relative py-20 bg-linear-footer">
            <div class="container">
            <div class="flex max-lg:flex-wrap items-start justify-between gap-10 xl:gap-[125px]">
                <div class="space-y-6 max-lg:mx-auto">
                    <div class="max-w-[300px] max-h-[40px]">
                        <Link :href="route('home')">
                            <JPicture src="/assets/images/logo.png" alt="logo" class="w-full h-full" />
                        </Link>
                    </div>
                    <div class="flex items-center gap-[18px]">
                        <div v-for="(itemSocial, indexSocial) in socials" :key="indexSocial">
                            <JPicture :src="itemSocial.icon" :alt="itemSocial.alt" class="w-full h-full object-cover" />
                        </div>
                    </div>
                </div>
                <div class="space-y-[14px] max-lg:w-full xl:w-[460px]">
                    <div
                        v-for="(itemInfo, indexInfo) in infos"
                        :key="indexInfo"
                        class="flex items-start gap-3 xl:gap-4"
                    >
                        <div
                            class="flex-shrink-0 w-7 h-7 -mt-0.5"
                        >
                            <JPicture :src="itemInfo.icon" alt="icon info" class="picture-cover"/>
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
                <div class="max-w-full lg:max-w-[281px] w-full relative">
                   <FooterContact @success="handleSuccess" />
                </div>
            </div>
        </div>
        </div>
        <!-- <div>
            <div class="container">
                <div class="flex justify-between space-x-4 items-center py-2.5 body-3 xl:px-6">
                    <div>
                        © {{ currentYear }} 90S HOUSE. - Design by <span><a href="https://betech-digital.com" target="_blank" rel="noopener noreferrer nofollow">Betech</a></span>
                    </div>
                    <div>{{ tt('All rights reserved.') }}</div>
                </div>
            </div>
                
        </div> -->
    </footer>
</template>
<script>
import FooterContact from '@/Components/FooterContact.vue'

export default {
    components: { FooterContact },
    data() {
        return {
            infos: [
                {
                    icon: '/assets/images/image-footer-address.png',
                    content: this.$page.props.global.address ?? '90 Lê Thị Riêng, Phường Phạm Ngũ Lão, TP Ho Chi Minh, Vietnam',
                    href: this.$page.props.global.link_address ?? 'https://maps.app.goo.gl/MgwfTks1FEHyDqdy9',
                    target: '_blank',
                },
                {
                    icon: '/assets/images/image-footer-contact.png',
                    content: this.$page.props.global.general_phone ?? '090 678 35 78',
                    href: `tel:${this.$page.props.global.general_phone ?? '090 678 35 78'}`,
                    target: '_self',
                },
                {
                    icon: '/assets/images/image-footer-mail.png',
                    content: this.$page.props.global.mail_marketing ?? 'MIMIPARTY@gmail.com',
                    href: `mailto:${this.$page.props.global.mail_marketing ?? 'MIMIPARTY@gmail.com'}`,
                    target: '_self',
                },
                {
                    icon: '/assets/images/image-footer-website.png',
                    content: this.tt('MIMIPARTY.com'),
                    href: this.tt('https://miniparty.com'),
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
    methods: {
        handleSuccess() {
            // Hiển thị modal thành công hoặc xử lý khác
        }
    }    
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
.bg-linear-footer {
    background: linear-gradient(92.52deg, #020C1F 2.35%, #031537 60.87%, #073385 102.5%);
}
</style>
