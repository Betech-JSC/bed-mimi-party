<template>
    <div>
        <div class="space-y-6">
            <h2 class="title-1 text-white font-bold">{{ tt('Contact us') }}</h2>
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
                <button class="body-1 font-semibold uppercase rounded-full border border-white text-white text-center py-1.5 w-full" @click="contact">{{ tt('Gửi yêu cầu') }}</button>
            </div>
        </div>

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
    </div>
</template>

<script>
import { validateForm } from '@/validator'
import JamFieldSet from '@/Components/Jam/FieldSet.vue'

const emptyForm = {
    Name: '',
    Phone: null,
    Email: '',
    'Nội dung yêu cầu': '',
}

export default {
    name: 'FooterContact',
    components: { JamFieldSet },
    emits: ['success'],
    data() {
        return {
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
        }
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
                    this.isSubmit = true
                    this.isLoading = false
                    this.isSuccess = true
                    document.body.classList.add('overflow-hidden')
                    this.$emit('success')
                },
                onError: () => {
                    this.isLoading = false
                }
            })
        },
        setIsSubmit(val) {
            this.isSubmit = val
        },
        closePopup() {
            this.isSuccess = false
            document.body.classList.remove('overflow-hidden')
        },
    },
}
</script>
