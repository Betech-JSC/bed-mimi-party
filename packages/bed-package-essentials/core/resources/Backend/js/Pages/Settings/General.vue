<template layout>

    <Head :title="tt('models.titles.setting')" />
    <WrapSetting>
        <Form v-model="formData" :config="{ canDestroy: false, reverse: true, addGrid: false, resource: 'settings' }">
            <template #default="{ form }">
                <div class="card">
                    <div class="card-body">
                        <Field v-model="form.general_business_name" :field="{
                            name: 'general_business_name',
                        }" />
                        <Field v-model="form.general_site_name" :field="{
                            name: 'general_site_name',
                        }" />
                        <Field v-model="form.general_email" :field="{
                            name: 'general_email',
                        }" />
                        <Field v-model="form.general_phone" :field="{
                            name: 'general_phone',
                            label: 'Phone',
                        }" />
                        <Field v-model="form.general_fb_link" :field="{
                            name: 'general_fb_link',
                            label: 'Fb Link',
                        }" />
                        <Field v-model="form.general_message_fb_link" :field="{
                            name: 'general_message_fb_link',
                            label: 'Fb Message Link',
                        }" />
                        <Field v-model="form.general_instagram_link" :field="{
                            name: 'general_instagram_link',
                            label: 'Instagram Link',
                        }" />
                        <Field v-model="form.general_youtube_link" :field="{
                            name: 'general_youtube_link',
                            label: 'Youtube Link',
                        }" />
                        <Field v-model="form.general_linkedin_link" :field="{
                            name: 'general_linkedin_link',
                            label: 'Linkedin Link',
                        }" />
                        <Field v-model="form.general_zalo_link" :field="{
                            name: 'general_zalo_link',
                            label: 'Zalo Link',
                        }" />
                        <Field v-model="form.general_twitter_link" :field="{
                            name: 'general_twitter_link',
                            label: 'Twitter Link',
                        }" />
                        <Field v-model="form.general_tiktok_link" :field="{
                            name: 'general_tiktok_link',
                            label: 'Tiktok Link',
                        }" />
                        <Field v-model="form.mail_marketing" :field="{
                            name: 'mail_marketing',
                            label: 'Mail Marketing',
                        }" />
                        <Field v-model="form.mail_sale" :field="{
                            name: 'mail_sale',
                            label: 'Mail Sale',
                        }" />
                        <Field v-model="form.link_website" :field="{
                            name: 'link_website',
                            label: 'Link website',
                        }" />
                        <Field v-model="form.address" :field="{
                            name: 'address',
                            label: 'Địa chỉ',
                        }" />
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">Home Page Content</div>
                        <Field v-model="form.the_homepage_content" :field="{
                            type: 'richtext',
                            name: 'the_homepage_content',
                            label: 'Homepage Content',
                        }" />
                        <Field v-model="form.the_homepage_desciption" :field="{
                            type: 'richtext',
                            name: 'the_homepage_desciption',
                            label: 'Homepage Description',
                        }" />
                        
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="card-header">About Page Content</div>

                            <!-- SectionService -->
                            <Field v-model="form.section_service_description"
                                :field="{ type: 'richtext', name: 'section_service_description', label: 'Section Service - Description' }" />

                            <Field v-model="form.section_service_card_1_title"
                                :field="{ type: 'text', name: 'section_service_card_1_title', label: 'Service Card 1 - Title' }" />
                            <Field v-model="form.section_service_card_1_description"
                                :field="{ type: 'richtext', name: 'section_service_card_1_description', label: 'Service Card 1 - Description' }" />

                            <Field v-model="form.section_service_card_2_title"
                                :field="{ type: 'text', name: 'section_service_card_2_title', label: 'Service Card 2 - Title' }" />
                            <Field v-model="form.section_service_card_2_description"
                                :field="{ type: 'richtext', name: 'section_service_card_2_description', label: 'Service Card 2 - Description' }" />

                            <Field v-model="form.section_service_card_3_title"
                                :field="{ type: 'text', name: 'section_service_card_3_title', label: 'Service Card 3 - Title' }" />
                            <Field v-model="form.section_service_card_3_description"
                                :field="{ type: 'richtext', name: 'section_service_card_3_description', label: 'Service Card 3 - Description' }" />


                            <!-- SectionCommit -->
                            <Field v-model="form.section_commit_title"
                                :field="{ type: 'text', name: 'section_commit_title', label: 'Section Commit - Title' }" />
                            <Field v-model="form.section_commit_description"
                                :field="{ type: 'richtext', name: 'section_commit_description', label: 'Section Commit - Description' }" />

                            <Field v-model="form.section_commit_card_1_title"
                                :field="{ type: 'text', name: 'section_commit_card_1_title', label: 'Commit Card 1 - Title' }" />
                            <Field v-model="form.section_commit_card_1_description"
                                :field="{ type: 'richtext', name: 'section_commit_card_1_description', label: 'Commit Card 1 - Description' }" />

                            <Field v-model="form.section_commit_card_2_title"
                                :field="{ type: 'text', name: 'section_commit_card_2_title', label: 'Commit Card 2 - Title' }" />
                            <Field v-model="form.section_commit_card_2_description"
                                :field="{ type: 'richtext', name: 'section_commit_card_2_description', label: 'Commit Card 2 - Description' }" />

                            <Field v-model="form.section_commit_card_3_title"
                                :field="{ type: 'text', name: 'section_commit_card_3_title', label: 'Commit Card 3 - Title' }" />
                            <Field v-model="form.section_commit_card_3_description"
                                :field="{ type: 'richtext', name: 'section_commit_card_3_description', label: 'Commit Card 3 - Description' }" />

                            <Field v-model="form.section_commit_card_4_title"
                                :field="{ type: 'text', name: 'section_commit_card_4_title', label: 'Commit Card 4 - Title' }" />
                            <Field v-model="form.section_commit_card_4_description"
                                :field="{ type: 'richtext', name: 'section_commit_card_4_description', label: 'Commit Card 4 - Description' }" />


                            <!-- SectionReasons -->
                            <Field v-model="form.section_reasons_title"
                                :field="{ type: 'text', name: 'section_reasons_title', label: 'Section Reasons - Title' }" />

                            <Field v-model="form.section_reasons_card_1_title"
                                :field="{ type: 'text', name: 'section_reasons_card_1_title', label: 'Reason Card 1 - Title' }" />
                            <Field v-model="form.section_reasons_card_1_description"
                                :field="{ type: 'richtext', name: 'section_reasons_card_1_description', label: 'Reason Card 1 - Description' }" />

                            <Field v-model="form.section_reasons_card_2_title"
                                :field="{ type: 'text', name: 'section_reasons_card_2_title', label: 'Reason Card 2 - Title' }" />
                            <Field v-model="form.section_reasons_card_2_description"
                                :field="{ type: 'richtext', name: 'section_reasons_card_2_description', label: 'Reason Card 2 - Description' }" />

                            <Field v-model="form.section_reasons_card_3_title"
                                :field="{ type: 'text', name: 'section_reasons_card_3_title', label: 'Reason Card 3 - Title' }" />
                            <Field v-model="form.section_reasons_card_3_description"
                                :field="{ type: 'richtext', name: 'section_reasons_card_3_description', label: 'Reason Card 3 - Description' }" />

                            <Field v-model="form.section_reasons_card_4_title"
                                :field="{ type: 'text', name: 'section_reasons_card_4_title', label: 'Reason Card 4 - Title' }" />
                            <Field v-model="form.section_reasons_card_4_description"
                                :field="{ type: 'richtext', name: 'section_reasons_card_4_description', label: 'Reason Card 4 - Description' }" />
                        </div>

                    </div>

                </div>
                <SeoFields :modelValue="form" @update:modelValue="form = $event" :config="{
                    hiddenFields: ['seo_slug'],
                }" />
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
