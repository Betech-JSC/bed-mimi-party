<template>
    <main class="bg-black">
        <section class="pt-12 md:pb-16 pb-12 xl:pb-20 relative overflow-hidden">
            <div class="circle-orange !h-[350px] left-[-350px] top-[100px]"></div>
            <div class="relative z-10">
                <div class="container md:space-y-12 space-y-8 xl:space-y-[120px]">
                    <TextAnimation
                        className="text-center"
                        :textFirst="tt('Get in touch ')"
                        :textSecond="tt('with us')"
                    />

                    <div class="grid grid-cols-12 gap-y-4 md:gap-6 xl:gap-8">
                        <div class="col-span-full lg:col-span-4 xl:col-span-5">
                            <div class="space-y-8 py-6">
                                <h2 class="headline-3 text-white uppercase">{{ tt('Contact us') }}</h2>
                                <div class="md:space-y-5 space-y-4 xl:space-y-6 body-1">
                                    <JamFieldSet
                                        v-model="form.contact.data.Name"
                                        :field="{
                                            rules: rules,
                                            errors: errors,
                                            type: 'text',
                                            placeholder: tt('Name'),
                                            name: 'Họ và tên',
                                            fieldName: 'Name',
                                            errorText: tt('Họ tên không hợp lệ'),
                                        }"
                                        :isSubmit="isSubmit"
                                        @setIsSubmit="setIsSubmit"
                                        :isContact="true"
                                    />
                                    <JamFieldSet
                                        v-model="form.contact.data.Email"
                                        :field="{
                                            rules: rules,
                                            errors: errors,
                                            type: 'email',
                                            placeholder: tt('Email'),
                                            name: 'Email',
                                            fieldName: 'Email',
                                            errorText: tt('Email không hợp lệ'),
                                        }"
                                        :isSubmit="isSubmit"
                                        @setIsSubmit="setIsSubmit"
                                        :isContact="true"
                                    />
                                    <JamFieldSet
                                        v-model="form.contact.data.Phone"
                                        :field="{
                                            rules: rules,
                                            errors: errors,
                                            type: 'number',
                                            placeholder: tt('Số điện thoại'),
                                            name: 'Số điện thoại',
                                            fieldName: 'Phone',
                                            errorText: tt('Số điện thoại không hợp lệ'),
                                        }"
                                        :isSubmit="isSubmit"
                                        @setIsSubmit="setIsSubmit"
                                        :isContact="true"
                                    />
                                    <JamFieldSet
                                        v-model="form.contact.data['Nội dung yêu cầu']"
                                        :field="{
                                            rules: rules,
                                            errors: errors,
                                            type: 'text',
                                            placeholder: tt('Lời nhắn'),
                                            name: 'Nội dung yêu cầu',
                                            fieldName: 'note',
                                            errorText: tt('Họ tên không hợp lệ'),
                                        }"
                                        :isSubmit="isSubmit"
                                        @setIsSubmit="setIsSubmit"
                                        :isContact="true"
                                    />
                                </div>
                                <div>
                                    <ButtonSubmit @click="contact">{{ tt('Gửi yêu cầu') }}</ButtonSubmit>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-full md:col-span-6 lg:col-span-4 xl:col-span-3">
                            <div class="space-y-[14px] py-8">
                                <div v-for="(itemInfo, indexInfo) in infos" :key="indexInfo" class="space-y-4">
                                    <div class="w-full text-white/60 body-3 uppercase !font-display flex-shrink-0 mt-1">
                                        {{ itemInfo.title }}
                                    </div>
                                    <div class="body-1 text-white lg:hover:text-primary duration-300 ease-in-out">
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
                        </div>
                        <div class="col-span-full md:col-span-6 lg:col-span-4">
                            <JPicture
                                src="/assets/images/contact/image-contact.jpg"
                                alt="image contact"
                                class="w-full h-full object-cover"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full h-[250px] md:h-[400px] xl:h-[600px] relative overflow-hidden">
            <VideoFullScreen videoSrc="/assets/video/video-hero.mp4" poster="/assets/placeholder.jpg" />
        </section>
        <ModalSuccess
            @close="closePopup"
            :isSuccess="isSuccess"
            :title="tt('Yêu cầu thành công')"
            :description="
                tt(
                    'Hệ thống đã nhận thông tin yêu cầu của khách hàng. Chúng tôi sẽ liên hệ và tư vấn Quý khách trong thời gian sớm nhất.'
                )
            "
        />
    </main>
</template>
<script>
import { validateForm } from '@/validator'
import Pagination from '@/Components/Paginate.vue'
import JamFieldSet from '../Components/Jam/FieldSet.vue'
import JamBreadcrumb from '@/Components/Jam/Breadcrumb.vue'
import ChevronContact from '@/Components/Icons/ChevronContact.vue'
const emptyForm = {
    Name: '',
    Phone: null,
    Email: '',
    note: '',
}
export default {
    props: ['agencies'],
    components: { JamFieldSet, Pagination, JamBreadcrumb, ChevronContact },
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
            form: {
                contact: {
                    data: {
                        ...emptyForm,
                    },
                    type: 'CONTACT_FORM',
                },
            },
            rules: {
                Name: 'required|min:3|max:25',
                Phone: 'phone|required|min:10|max:11',
                Email: 'email|required',
            },
            errors: {},
            isSuccess: false,
            isLoading: false,
            isSubmit: false,
            breadcrumbs: [
                {
                    title: this.tt('Liên hệ'),
                },
            ],
            isShowTypeService: false,
            servicesList: [],
            typeServiceActive: null,
            isEmptyService: false,
            screenWidth: 0,
        }
    },
    mounted() {
        if (this.$page.props.data.services && this.$page.props.data.services.length > 0) {
            this.servicesList = this.$page.props.data.services
        }
        this.screenWidth = window.innerWidth
    },
    methods: {
        contact() {
            this.errors = validateForm(this.form.contact.data, this.rules)

            if (Object.keys(this.errors).length > 0) {
                return false
            }
            this.isLoading = true

            this.$inertia.post('contacts', this.form, {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.contact.data = { ...emptyForm }
                    this.typeServiceActive = null
                    this.isEmptyService = false
                    this.isSuccess = true
                    this.isSubmit = true
                    this.isLoading = false
                    document.body.classList.add('overflow-hidden')
                },
            })
        },
        closePopup() {
            this.isSuccess = false
            document.body.classList.remove('overflow-hidden')
        },
        setIsSubmit(val) {
            this.isSubmit = val
        },
        toggleTypeService(event) {
            event.stopPropagation()
            this.isShowTypeService = !this.isShowTypeService
        },
        setTypeService(item) {
            this.typeServiceActive = item
            this.form.contact.data.Service.id = this.typeServiceActive.id
            this.form.contact.data.Service.title = this.typeServiceActive.title
            this.form.contact.data.Service.slug = this.typeServiceActive.slug
            this.isShowTypeService = false
        },
        hideBox() {
            this.isShowTypeService = false
        },
    },
}
</script>
<style lang="scss" scoped>
/* width */
::-webkit-scrollbar {
    width: 8px;
    background: white;
    border-radius: 30px;
}
/* Handle */
::-webkit-scrollbar-thumb {
    @apply bg-gray-200 rounded-[30px];
}
/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    @apply bg-gray-400;
}
.select-shadow {
    box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
}
.gg-spinner {
    transform: scale(var(--ggs, 1));
}

.gg-spinner,
.gg-spinner::after,
.gg-spinner::before {
    box-sizing: border-box;
    position: relative;
    display: block;
    width: 1rem;
    height: 1rem;
}

.gg-spinner::after,
.gg-spinner::before {
    content: '';
    position: absolute;
    border-radius: 100px;
}

.gg-spinner::before {
    animation: spinner 1s cubic-bezier(0.6, 0, 0.4, 1) infinite;
    border: 3px solid transparent;
    border-top-color: currentColor;
}

.gg-spinner::after {
    border: 3px solid;
    opacity: 0.2;
}

@keyframes spinner {
    0% {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(359deg);
    }
}
:deep(.banner-shape) {
    img {
        @apply max-md:w-full max-md:h-full max-md:object-cover;
    }
}
</style>
