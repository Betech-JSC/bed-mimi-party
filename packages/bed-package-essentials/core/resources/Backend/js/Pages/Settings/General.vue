<template layout>
    <Head :title="tt('models.titles.setting')" />
    <WrapSetting>
        <Form v-model="formData" :config="{ canDestroy: false, reverse: true, addGrid: false, resource: 'settings' }">
            <template #default="{ form }">
                <div class="card">
                    <div class="card-body">
                        <Field
                            v-model="form.general_business_name"
                            :field="{
                                name: 'general_business_name',
                            }"
                        />
                        <Field
                            v-model="form.general_site_name"
                            :field="{
                                name: 'general_site_name',
                            }"
                        />
                        <Field
                            v-model="form.general_email"
                            :field="{
                                name: 'general_email',
                            }"
                        />
                        <Field
                            v-model="form.general_phone"
                            :field="{
                                name: 'general_phone',
                                label: 'Phone',
                            }"
                        />
                        <Field
                            v-model="form.general_fb_link"
                            :field="{
                                name: 'general_fb_link',
                                label: 'Fb Link',
                            }"
                        />
                        <Field
                            v-model="form.general_message_fb_link"
                            :field="{
                                name: 'general_message_fb_link',
                                label: 'Fb Message Link',
                            }"
                        />
                        <Field
                            v-model="form.general_instagram_link"
                            :field="{
                                name: 'general_instagram_link',
                                label: 'Instagram Link',
                            }"
                        />
                        <Field
                            v-model="form.general_youtube_link"
                            :field="{
                                name: 'general_youtube_link',
                                label: 'Youtube Link',
                            }"
                        />
                        <Field
                            v-model="form.general_linkedin_link"
                            :field="{
                                name: 'general_linkedin_link',
                                label: 'Linkedin Link',
                            }"
                        />
                        <Field
                            v-model="form.general_zalo_link"
                            :field="{
                                name: 'general_zalo_link',
                                label: 'Zalo Link',
                            }"
                        />
                        <Field
                            v-model="form.general_twitter_link"
                            :field="{
                                name: 'general_twitter_link',
                                label: 'Twitter Link',
                            }"
                        />
                            <Field
                            v-model="form.general_tiktok_link"
                            :field="{
                                name: 'general_tiktok_link',
                                label: 'Tiktok Link',
                            }"
                        />
                        <Field
                            v-model="form.mail_marketing"
                            :field="{
                                name: 'mail_marketing',
                                label: 'Mail Marketing',
                            }"
                        />
                        <Field
                            v-model="form.mail_sale"
                            :field="{
                                name: 'mail_sale',
                                label: 'Mail Sale',
                            }"
                        />
                        <Field
                            v-model="form.link_website"
                            :field="{
                                name: 'link_website',
                                label: 'Link website',
                            }"
                        />
                        <Field
                            v-model="form.address"
                            :field="{
                                name: 'address',
                                label: 'Địa chỉ',
                            }"
                        />
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <Field
                            v-model="form.the_homepage_content"
                            :field="{
                                type: 'richtext',
                                name: 'the_homepage_content',
                                label: 'Homepage Content',
                            }"
                        />
                        <Field
                            v-model="form.the_about_content"
                            :field="{
                                type: 'richtext',
                                name: 'the_about_content',
                                label: 'About Content',
                            }"
                        />
                        <Field
                            v-model="form.the_venue_content"
                            :field="{
                                type: 'richtext',
                                name: 'the_venue_content',
                                label: 'MiMi Party Content',
                            }"
                        />
                    </div>
                </div>
                <SeoFields
                    :modelValue="form"
                    @update:modelValue="form = $event"
                    :config="{
                        hiddenFields: ['seo_slug'],
                    }"
                />
                <Field class="hidden" disabled v-model="form.id" :field="{ default: 'general' }" />
            </template>
        </Form>
    </WrapSetting>
</template>
<script>
import WrapSetting from '@Core/Components/WrapSetting.vue'
export default {
    components: { WrapSetting },
    props: ['item', 'schema'],
    data() {
        return {
            formData: this.item,
        }
    },
}
</script>
