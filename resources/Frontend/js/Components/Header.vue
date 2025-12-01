<template>
    <header class="fixed inset-x-0 top-0 z-[1000]" @mouseleave="menuSelected = null">
        <div
            class="relative bg-header md:h-[var(--header-height-md)] h-[var(--header-height-sm)] lg:h-[var(--header-height-lg)] xl:h-[var(--header-height-xl)] flex items-center justify-center"
        >
            <div class="px-4 md:px-8 xl:px-12 flex items-center justify-between w-full">
                <Logo />
                <div class="max-lg:hidden space-y-[12px]">
                    <ul class="flex items-center space-x-6 body-0 uppercase">
                        <li>
                            <a
                                href="/"
                                class="p-1.5 border-b relative block"
                                :class="
                                    $page.props.route.path === '/'
                                        ? 'text-white/100 border-primary text-shadow-glow-white font-semibold'
                                        : 'border-transparent text-white/80 font-medium'
                                "
                            >
                                {{ tt('Trang chủ') }}
                            </a>
                        </li>
                        <template v-for="(menu, index) in menus" :key="index">
                            <li
                                v-if="menu && menu.title !== ''"
                                @mouseover="setMenuSelected(menu)"
                                @mouseenter="setFirstSubMenu"
                            >
                                <Link
                                    :href="menu.slug"
                                    class="p-1.5 border-b relative block"
                                    :class="
                                        fullPath.includes(menu.slug) && $page.props.route.path !== '/'
                                            ? 'text-white/100 border-primary text-shadow-glow-white font-semibold'
                                            : 'border-transparent text-white/80 font-medium'
                                    "
                                    @click="menuSelected = null"
                                >
                                    {{ menu.title }}
                                </Link>
                            </li>
                        </template>
                    </ul>
                </div>
                <div class="lg:hidden flex items-center gap-4">
                    <div class="flex items-center justify-center">
                        <button @click="onToggleMenu()">
                            <Hamburger :isToggleMenu="isToggleMenu" />
                        </button>
                    </div>
                </div>
            </div>

            <div
                class="fixed md:top-[var(--header-height-md)] top-[var(--header-height-sm)] w-full h-full z-[1000] lg:hidden"
                :class="isToggleMenu ? 'right-0' : '-right-full'"
                style="transition: right 0.5s"
            >
                <div
                    class="w-full md:w-[50vw] h-full bg-black absolute z-30 duration-300 px-6 py-10 space-y-4"
                    :class="isToggleMenu ? 'right-0' : '-right-full'"
                    style="transition: right 0.5s"
                >
                    <ul class="space-y-4 body-0 uppercase">
                        <li class="flex items-center justify-between py-2 font-medium">
                            <a
                                href="/"
                                class="block w-full"
                                :class="
                                    $page.props.route.path === '/'
                                        ? 'text-white/100 text-shadow-glow-white'
                                        : 'text-white/80'
                                "
                            >
                                {{ tt('Trang chủ') }}
                            </a>
                        </li>
                        <li
                            v-for="(menuMb, menuMbIndex) in menus"
                            class="flex items-center justify-between py-2"
                            :class="fullPath.includes(menuMb.slug) && $page.props.route.path !== '/' ? 'text-white/100 text-shadow-glow-white' : 'text-white/80'"
                            :key="menuMbIndex"
                        >
                            <Link :href="menuMb.slug" @click="closeMenu()" class="block w-full">{{
                                menuMb.title
                            }}</Link>
                        </li>
                    </ul>

                    <!-- Bắt buộc có để Google init, mình ẩn đi -->
                    <div id="google_translate_element" class="hidden"></div>
                </div>
            </div>
        </div>
        <div
            @mouseenter="setBackgroundHover('leave')"
            :class="hoverBackground ? 'visible duration-100' : 'invisible duration-100'"
            class="absolute w-screen h-screen bg-black opacity-50 z-1"
        ></div>
    </header>
</template>
<script>
import DropdownArrow from './Icons/DropdownArrow.vue'
import Phone from './Icons/Phone.vue'
import Mail from './Icons/Mail.vue'
import Cart from './Icons/Cart.vue'
import Global from './Icons/Global.vue'

import axios from 'axios'
import { useAppStore } from '@/stores/index'

export default {
    props: {
        fullPath: {
            type: String,
            default: '',
        },
        fullRoute: {
            type: String,
            default: '',
        },
    },
    components: { DropdownArrow, Phone, Mail, Cart, Global },
    directives: {
        'click-outside': {
            beforeMount: (el, binding) => {
                el.clickOutsideEvent = (event) => {
                    // here I check that click was outside the el and his children
                    if (!(el == event.target || el.contains(event.target))) {
                        // and if it did, call method provided in attribute value
                        binding.value()
                    }
                }
                document.addEventListener('click', el.clickOutsideEvent)
            },
            unmounted: (el) => {
                document.removeEventListener('click', el.clickOutsideEvent)
            },
        },
    },
    data() {
        return {
            inited: false,
            activeHover: false,
            isOpenSearch: false,
            menus: [
                {
                    title: this.tt(`Về chúng tôi`),
                    slug: this.route('histories.index'),
                    type: 'histories',
                    subMenu: [],
                },
                {
                    title: this.tt('Dịch vụ'),
                    slug: this.route('services'),
                    type: 'services',
                    subMenu: [],
                },
                {
                    title: this.tt('Dự án'),
                    slug: this.route('projects.index'),
                    type: 'projects',
                    subMenu: [],
                },
                {
                    title: this.tt('Tin tức'),
                    slug: this.route('posts'),
                    type: 'posts',
                    subMenu: [],
                },
                {
                    title: this.tt('Liên hệ'),
                    slug: this.route('contact'),
                    type: 'contact',
                    subMenu: [],
                },
            ],
            hoverBackground: false,
            menuSelected: null,
            isCartMenuOpen: false,
            subMenuSelected: null,
            isActive: '',
            currentLan: null,
            isToggleLanBox: false,
            isToggleMenu: false,
            isToggleSubMenu: false,
            currentType: '',
            currentSubMenu: [],
            languageList: [
                {
                    title: 'VI',
                    type: 'vi',
                    link: '/',
                },
                {
                    title: 'EN',
                    type: 'en',
                    link: '/en',
                },
            ],

            isLoading: false,
            searchText: this.$attrs.keyword || '',

            instantSearch: [],
            isLoadingSearch: false,
            QUANTITY_SUBMENU: 11,
            showMegaMb: false,
            collapseActive: null,
            isShowPopupSearch: false,
            menuSelected: null,
            menuSubSelected: null,
            recently_search: this.$page.props.data.recently_search || [],
        }
    },
    computed: {
        appStore() {
            return useAppStore()
        },
        locationID: function () {
            return useAppStore().locationID
        },
        productsMenuSubSelected() {
            if (!this.menuSubSelected) return []
            return this.menuSubSelected.products || []
        },
        cartData() {
            return useAppStore().cart
        },
        isShowPopupSearchInit() {
            return this.isShowPopupSearch && (this.keywords.length > 0 || this.recently_search.length > 0)
        },

        flashSale() {
            return this.$page.props.data.flash_sale || null
        },
        keywords() {
            return this.$page.props.data.keywords || []
        },
        categories() {
            return this.$page.props.data.menu_categories || []
        },
        hasColMenu() {
            return this.subMenusColOne.length > 0 || this.subMenusColTwo.length > 0 || this.subMenusColThree.length > 0
        },
        subMenusColOne() {
            if (!this.menuSubSelected) return []

            return this.menuSubSelected.nodes.slice(0, this.QUANTITY_SUBMENU)
        },
        subMenusColTwo() {
            if (!this.menuSubSelected) return []

            return this.menuSubSelected.nodes.slice(this.QUANTITY_SUBMENU, this.QUANTITY_SUBMENU * 2)
        },
        subMenusColThree() {
            if (!this.menuSubSelected) return []
            return this.menuSubSelected.nodes.slice(this.QUANTITY_SUBMENU * 2, this.QUANTITY_SUBMENU * 3)
        },
    },
    watch: {
        '$attrs.keyword'(newVal) {
            if (this.isShowroomPage) return
            if (!newVal) {
                this.searchText = ''
            } else {
                this.searchText = newVal
            }
        },
        searchText(newVal) {
            if (
                newVal &&
                (this.recently_search.includes(newVal) || this.keywords.includes(newVal)) &&
                !this.isShowPopupSearch
            ) {
                return
            }

            this.searchProduct()
        },
        isShowPopupSearch(newVal) {
            if (newVal) {
                window.addEventListener('click', this.closePopupSearch)
            } else {
                window.removeEventListener('click', this.closePopupSearch)
            }
        },
        '$page.url': function (newURL) {
            this.instantSearch = []
            this.isShowPopupSearch = false
            if (newURL !== this.route('search', { keyword: this.searchText })) {
                this.searchText = ''
            }
        },
        quantity(newVal, oldVal) {
            if (this.isLoading) return
            if (newVal === 0) {
                this.deleteCart()
            } else {
                if (newVal > oldVal) {
                    this.tracking(newVal - oldVal)
                }
                this.updateCart()
            }
        },
        cart(newVal) {
            if (newVal && newVal.qty) {
                this.quantity = Number(newVal.qty)
            }
        },
    },
    methods: {
        handleSearch() {
            if (this.searchText.trim() === '' || this.isLoading) return
            this.instantSearch = []
            this.isShowPopupSearch = false
            this.isOpenSearch = false
            this.isToggleMenu = false
            this.isLoading = true

            if (typeof fbq !== 'undefined') {
                fbq('track', 'Search', {
                    search_string: this.searchText,
                })
            }
            if (typeof ttq !== 'undefined') {
                ttq.track('Search', {
                    search_string: this.searchText,
                })
            }
            const BASE_URL = this.route('search')
            this.$inertia.visit(BASE_URL, {
                preserveScroll: true,
                data: {
                    keyword: this.searchText,
                },
                onFinish: () => {
                    this.isLoading = false
                },
            })
        },
        async searchProduct() {
            if (this.isLoading) {
                this.instantSearch = []
                return
            }

            if (this.isLoadingSearch) return
            this.isLoadingSearch = true

            if (this.searchText.trim() === '') {
                this.instantSearch = []
            } else {
                const { data } = await axios.get(this.route('instant_search', { keyword: this.searchText }))
                this.instantSearch = data?.data?.products || []
            }

            this.isLoadingSearch = false
        },
        onOpenSearch() {
            this.isOpenSearch = !this.isOpenSearch
        },
        setMenuSelected(item) {
            this.menuSelected = item
        },
        setFirstSubMenu() {
            if (this.menuSelected.subMenu && this.menuSelected.subMenu.length > 0) {
                this.subMenuSelected = this.menuSelected.subMenu[0]
            }
        },
        setBackgroundHover(type) {
            console.log('type', type)
            type === 'enter' ? (this.hoverBackground = true) : (this.hoverBackground = false)
        },
        setSubMenuSelected(item) {
            this.subMenuSelected = item
        },
        activeMenu(slug) {
            const splitPath = this.fullPath.split('/')
            return slug === splitPath[splitPath.length - 1]
        },
        toggleLanBox() {
            this.isToggleLanBox = !this.isToggleLanBox
        },
        hideBox() {
            this.isToggleLanBox = false
        },
        onToggleMenu() {
            this.isToggleMenu = !this.isToggleMenu
            this.isCartMenuOpen = false
        },
        onToggleCartMenu() {
            if (this.isToggleMenu === false) {
                this.isCartMenuOpen = !this.isCartMenuOpen
            }
        },
        closeMenu() {
            const el = document.body
            el.classList.remove('overflow-hidden', 'menu-is-opened')
            this.isToggleMenu = false
            this.isToggleSubMenu = false
        },
        toggleSubMenu(arr, type) {
            this.isToggleSubMenu = !this.isToggleSubMenu
            this.currentSubMenu = arr
            this.currentType = type
        },
        closeSubMenu() {
            this.isToggleSubMenu = false
        },
        async updateCart() {
            if (this.isLoading) return
            this.isLoading = true

            let cartOrder = null

            const { data } = await axios.put(
                this.route('checkout.cart.update', {
                    rowId: this.cart.rowId,
                    quantity: this.quantity,
                })
            )

            cartOrder = data

            if (this.locationID) {
                const base_url = this.route('checkout.shipping')
                const { data } = await axios.get(base_url, {
                    params: {
                        region: this.locationID,
                    },
                })
                // TODO
                if (data?.data) cartOrder = data.data
            }

            this.appStore.$patch({
                cart: cartOrder,
            })
            this.isLoading = false
        },
        async deleteCart(rowId) {
            if (this.isLoading) return
            this.isLoading = true

            let cartOrder = null

            const { data } = await axios.put(
                this.route('checkout.cart.destroy', {
                    rowId: rowId,
                })
            )

            cartOrder = data

            if (this.locationID) {
                const base_url = this.route('checkout.shipping')
                const { data } = await axios.get(base_url, {
                    params: {
                        region: this.locationID,
                    },
                })
                // TODO
                if (data?.data) cartOrder = data.data
            }
            this.appStore.$patch({
                cart: cartOrder,
            })
            this.isLoading = false
        },

        switchLang(lang) {
            const target = lang === 'en' ? 'en' : 'vi'

            const apply = () => {
                const sel = document.querySelector('select.goog-te-combo')
                if (!sel) return false
                sel.value = target
                sel.dispatchEvent(new Event('change'))
                this.curr = target

                // 🔥 Nuke banner + fix body ngay khi đổi ngữ
                this.nukeBanner()
                this.ensureBodyTop()

                this.$inertia.visit(`/${target === 'vi' ? '' : 'en'}`, {
                    replace: true,
                    preserveState: true,
                    onFinish: () => {
                        // Reload lại trang sau khi ngôn ngữ thay đổi
                        window.location.reload() // Đây sẽ reload trang sau khi URL được thay đổi
                    },
                })

                return true
            }

            if (!apply()) {
                let tries = 0
                const itv = setInterval(() => {
                    tries++
                    if (apply() || tries > 50) clearInterval(itv) // ~5s
                }, 100)
            }

            this.isOpen = false
            this.isToggleMenu = false
        },

        // Gỡ sạch mọi iframe/banner Google + tooltip nếu bị chèn lại
        nukeBanner() {
            // 1) Bắn ngay lập tức
            const killOnce = () => {
                // Xóa tất cả iframes banner
                document.querySelectorAll('iframe.goog-te-banner-frame').forEach((el) => {
                    // Ẩn nếu không remove được
                    el.style.setProperty('display', 'none', 'important')
                    // Thử remove hẳn
                    try {
                        el.parentNode && el.parentNode.removeChild(el)
                    } catch {}
                })

                // Ẩn tooltip/popup
                const tt = document.getElementById('goog-gt-tt')
                if (tt) tt.style.setProperty('display', 'none', 'important')

                document
                    .querySelectorAll('.goog-te-balloon-frame, .goog-te-menu-frame')
                    .forEach((el) => el.style.setProperty('display', 'none', 'important'))

                // Ép body về top:0
                this.ensureBodyTop()
            }

            // 2) Poll vài giây vì Google có thể chèn trễ
            killOnce()
            let count = 0
            const itv = setInterval(() => {
                killOnce()
                count++
                if (count > 40) clearInterval(itv) // ~4s
            }, 100)
        },

        ensureBodyTop() {
            try {
                document.body.style.setProperty('top', '0px', 'important')
                document.documentElement.style.setProperty('top', '0px', 'important')
            } catch {}
        },
        injectCssHacks() {
            const css = `
                /* Ẩn banner ngang trên cùng */
                .goog-te-banner-frame { display: none !important; }
                body { top: 0 !important; }

                /* Ẩn tooltip & balloon & menu */
                #goog-gt-tt, .goog-te-balloon-frame, .goog-te-menu-frame { display: none !important; }
                .goog-text-highlight { background: none !important; box-shadow: none !important; }

                /* Ẩn gadget mặc định */
                .goog-te-gadget { display: none !important; }

                /* Giữ layout không bị đẩy xuống */
                html { position: static !important; }
                `
            const style = document.createElement('style')
            style.type = 'text/css'
            style.appendChild(document.createTextNode(css))
            document.head.appendChild(style)

            // Quan sát DOM – nếu Google chèn lại thì ẩn tiếp
            const mo = new MutationObserver(() => {
                const banner = document.querySelector('.goog-te-banner-frame')
                if (banner) {
                    banner.style.setProperty('display', 'none', 'important')
                    try {
                        banner.remove()
                    } catch {}
                }
                this.ensureBodyTop()
            })
            mo.observe(document.documentElement, { childList: true, subtree: true })
        },
    },

    mounted() {
        if (this.isShowPopupSearch) {
            this.instantSearch = []
        }

        this.injectCssHacks()

        // Lưu callback init ở scope global vì Google sẽ gọi theo tên này
        window.googleTranslateElementInit = () => {
            /* global google */
            try {
                new window.google.translate.TranslateElement(
                    {
                        pageLanguage: 'vi', // ngôn ngữ gốc
                        includedLanguages: 'vi,en', // chỉ bật VI & EN
                        autoDisplay: false,
                    },
                    'google_translate_element'
                )
                this.inited = true
                // Đồng bộ ngôn ngữ từ cookie/localStorage (nếu có)
                this.syncFromCookie()
                // Nếu trước đó user chọn EN thì tự áp lại
                const remembered = localStorage.getItem('lang_pref')
                if (remembered && remembered !== this.curr) {
                    this.switchLang(remembered)
                }
            } catch (e) {
                // no-op
            }
        }

        // Nạp script nếu chưa có
        if (!document.getElementById('google-translate-script')) {
            const s = document.createElement('script')
            s.id = 'google-translate-script'
            s.type = 'text/javascript'
            s.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'
            document.head.appendChild(s)
        } else {
            // Nếu nơi khác đã nạp, chủ động gọi init
            if (typeof window.googleTranslateElementInit === 'function') {
                window.googleTranslateElementInit()
            }
        }
    },
}
</script>
<style lang="scss">
body {
    --header-height-sm: 90px;
    --header-height-md: 90px;
    --header-height-lg: 90px;
    --header-height-xl: 90px;
}
</style>
<style lang="scss" scoped>
.bg-header {
 background: linear-gradient(180deg, #000000 0%, rgba(0, 0, 0, 0) 100%);
}
.header-shadow {
    box-shadow: 0 0 3px #1018280f, 0 1px 2px #1018280f;
}

.language-box {
    box-shadow: 0px 1px 2px 0px #1018280d;
}

@media screen and (min-width: 375px) {
    .header-shape {
        width: calc(100vw - ((100vw - 425px) / 2));
    }
}

@media screen and (min-width: 768px) {
    .header-shape {
        width: calc(100vw - ((100vw - 768px) / 2));
    }
}

@media screen and (min-width: 1024px) {
    .header-shape {
        width: calc(100vw - ((100vw - 1024px) / 2));
    }
}

@media screen and (min-width: 1280px) {
    .header-shape {
        width: calc(100vw - ((100vw - 1250px) / 2));
    }
}

@media screen and (min-width: 1366px) {
    .header-shape {
        width: calc(100vw - ((100vw - 1280px) / 2));
    }
}

@media screen and (min-width: 1440px) {
    .header-shape {
        width: calc(100vw - ((100vw - 1265px) / 2));
    }
}

.bg-gradient-header {
    background-image: linear-gradient(350.4deg, #2b40b6 3.98%, #2067e3 30%);
}

.text-gradient {
    background: var(--Gradient, linear-gradient(93deg, #afa38e 4.2%, #e0d8bf 72.2%, #a79c86 148.11%));
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.menu {
    max-height: 0;
    /* Chiều cao ban đầu */
    overflow: hidden;
    /* Ẩn nội dung thừa */
    opacity: 0;
    /* Ban đầu ẩn hoàn toàn nội dung */
    transition: max-height 0.4s ease-in-out, opacity 0.4s ease-in-out;
    /* Hiệu ứng đồng bộ */
}

.group:hover .menu {
    max-height: 90vh;
    /* Chiều cao tối đa khi hover */
    opacity: 1;
    /* Nội dung hiển thị dần */
}
</style>
