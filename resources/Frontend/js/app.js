import LayoutGuest from '@/Layouts/Guest.vue'
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import messages from '@intlify/unplugin-vue-i18n/messages'
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createPinia } from 'pinia'
import { createApp, h } from 'vue'
import { createI18n } from 'vue-i18n'
import { ObserveVisibility } from 'vue3-observe-visibility'
import route from 'ziggy-js'
import { Ziggy } from '../../../public/build/ziggy.frontend.js'
import VuePlyr from 'vue-plyr'
import 'vue-plyr/dist/vue-plyr.css'
import '../scss/app.scss'
import { TinyEmitter } from "tiny-emitter";

import AOS from 'aos';
import 'aos/dist/aos.css';

const emitter = new TinyEmitter();

const appName = window.document.getElementsByTagName('title')[0]?.innerText || import.meta.env.VITE_APP_NAME

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))

        page.then((module) => {
            module.default.layout = module.default.layout || LayoutGuest
        })
        return page
    },
    setup({ el, app, props, plugin }) {
        const i18n = createI18n({
            locale: props.initialPage.props.locale?.current,
            fallbackLocale: props.initialPage.props.locale?.default,
            legacy: false,
            globalInjection: true,
            messages: messages,
            missingWarn: false,
            fallbackWarn: false,
        });
        const vueApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(i18n)
            .use(AOS.init())
            .use(VuePlyr, { plyr: {} })
            .use(createPinia())
            .component('Link', Link)
            .component('Head', Head)
            .directive('observe-visibility', ObserveVisibility)
            .mixin({
                methods: {
                    routeLocaleName(name) {
                        const localeName = props.initialPage.props.locale?.current + '.' + name

                        return Ziggy.routes[localeName] ? localeName : name
                    },
                    route(
                        name,
                        params,
                        absolute,
                        config = {
                            ...Ziggy,
                            location: new URL(Ziggy.url),
                        }
                    ) {
                        console.log(name);
                        return route(this.routeLocaleName(name), params, absolute, config)
                    },
                    routes() {
                        return Ziggy.routes
                    },
                    tt(text) {
                        return this.$t(text)
                    },
                    toMoney: function (value) {
                        const { default: locale } = this.$inertia.page.props.locale;
                        let options = {};
                        if (locale === 'vi') {
                            options = {
                                minimumFractionDigits: 0,
                                style: 'currency',
                                currency: 'VND',
                            };
                        } else if (locale === 'en') {
                            options = {
                                minimumFractionDigits: 0,
                                style: 'currency',
                                currency: 'USD',
                            };
                        }

                        const formatter = new Intl.NumberFormat(locale, options);
                        let formattedValue = formatter.format(value ?? 0);

                        return formattedValue.trim();
                    },
                    formatDate: function (dateString) {
                        // Split the input date string into parts
                        const [year, month, day] = dateString.split("-");

                        // Define an array of months in Vietnamese
                        const months = [
                            "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5",
                            "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9",
                            "Tháng 10", "Tháng 11", "Tháng 12"
                        ];

                        // Get the correct month from the array (index is month - 1)
                        const formattedMonth = months[parseInt(month, 10) - 1];

                        // Return the formatted date
                        return `${day} ${formattedMonth}, ${year}`;
                    },
                    toNumber: function (value) {
                        return new Intl.NumberFormat('vi-VN', {
                            minimumFractionDigits: 1,
                            maximumFractionDigits: 4,
                            minimumSignificantDigits: 1,
                            maximumSignificantDigits: 4,
                        }).format(value)
                    },
                },
                mounted() {
                    AOS.refresh();
                }
            })

        vueApp.config.globalProperties.$bus = emitter;
        window.$route = route;
        return vueApp.mount(el);

    },
})
InertiaProgress.init({
    color: '#8F7153',
    showSpinner: true, // Hide the spinner
    delay: 200, // Show the progress bar after 200ms
})
