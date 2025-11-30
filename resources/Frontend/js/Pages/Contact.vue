<template>
    <main class="bg-primary-900">
        <section class="relative z-10 h-[252px]">
            <div class="absolute inset-0">
                <JPicture
                    src="/assets/images/contact/bg-banner.jpg"
                    loading="eager"
                    class="object-fit h-full w-full object-cover"
                    alt="image demo"
                />
            </div>
            <div class="absolute inset-0 w-full h-full bg-[#010A1C] bg-opacity-[56%]"></div>
            <div class="relative pb-12 h-full">
                <div class="container flex items-end mt-auto h-full">
                    <h2 class="title-linear display-2 uppercase font-extrabold">Liên hệ ngay</h2>
                </div>
            </div>
        </section>

        <section class="pt-12 md:pb-16 pb-12 xl:pb-20 relative overflow-hidden">
            <div class="absolute inset-0">
                <JPicture
                    src="/assets/images/contact/bg-contact.jpg"
                    loading="eager"
                    class="object-fit h-full w-full object-cover"
                    alt="image contact"
                />
            </div>
            <div class="relative z-10">
                <div class="container space-y-8 py-6">
                    <h3 class="headline-3 font-extrabold text-white uppercase">{{ tt('Thông tin cá nhân') }}</h3>
                    <div class="grid grid-cols-2 gap-x-12 gap-y-6 body-1">
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
                    <div class="grid grid-cols-3 gap-8">
                        <div class="col-span-2">
                            <h3 class="headline-3 font-extrabold text-white uppercase mb-6">{{ tt('Dịch vụ') }}</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div 
                                    v-for="(service, index) in services" 
                                    :key="index"
                                    class="flex items-start"
                                >
                                    <div class="checkbox">
                                        <input
                                            type="checkbox"
                                            :id="`service_${index}`"
                                            :name="`service_${index}`"
                                            v-model="selectedServices[index]"
                                        />
                                        <span></span>
                                        <label :for="`service_${index}`" class="text-white">
                                            {{ service }}
                                        </label>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-end justify-end">
                            <button class="btn btn-primary !w-full !justify-center" @click="contact">{{ tt('Gửi yêu cầu') }}</button>
                        </div>
                    </div>
                </div>
            </div>
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
                    if (!(el == event.target || el.contains(event.target))) {
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
            services: [
                'Decor Tiệc theo yêu cầu',
                'Dancer Feel & Performace',
                'Decor quán mùa lễ',
                'Liveband',
                'Decor trang trí bong bóng nghệ thuật',
                'Gói giải trí trọn gói',
                'Decor sinh nhật & concept',
                'Dịch vụ chụp ảnh, quay phim',
                'DJ & MC Hype'
            ],
            selectedServices: []
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
            
            // Lấy danh sách dịch vụ được chọn
            const selectedServicesList = this.services.filter((service, index) => this.selectedServices[index])
            
            // Thêm vào form data
            if (selectedServicesList.length > 0) {
                this.form.contact.data['Dịch vụ'] = selectedServicesList.join(', ')
            }
            
            this.isLoading = true

            this.$inertia.post('contacts', this.form, {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.contact.data = { ...emptyForm }
                    this.selectedServices = []
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

.checkbox {
    display: flex;
    align-items: flex-start;
    position: relative;
    cursor: pointer;
    user-select: none;
}

.checkbox input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.checkbox span {
    position: relative;
    height: 20px;
    width: 20px;
    background-color: transparent;
    border: 2px solid #cbd5e1;
    border-radius: 4px;
    margin-right: 12px;
    flex-shrink: 0;
    transition: all 0.2s ease;
}

.checkbox input[type="checkbox"]:checked ~ span {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

.checkbox span:after {
    content: "";
    position: absolute;
    display: none;
    left: 6px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.checkbox input[type="checkbox"]:checked ~ span:after {
    display: block;
}

.checkbox label {
    cursor: pointer;
    line-height: 1.4;
}
</style>
