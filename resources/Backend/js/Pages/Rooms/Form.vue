<template layout>
    <Form v-model="formData">
        <template #default="{ form }">
            <div class="card">
                <div class="card-header">{{ tt('models.setting.general_information') }}</div>
                <div class="card-body">
                    <Field
                        v-model="form.title"
                        :field="{
                            type: 'text',
                            name: 'title',
                            label: 'Tiêu đề',
                        }"
                    />
                    <Field
                        v-model="form.description"
                        :field="{
                            type: 'textarea',
                            name: 'description',
                            label: 'Mô tả',
                        }"
                    />
                    <Field
                        v-model="form.content"
                        :field="{
                            type: 'richtext',
                            name: 'content',
                            label: 'Nội dung',
                        }"
                    />
                </div>
            </div>
            <SeoFields :modelValue="form" @update:modelValue="form = $event" />
        </template>
        <template #aside="{ form }">
            <div class="card">
                <div class="card-body">
                    <Field
                        v-model="form.status"
                        :field="{
                            type: 'radio_list',
                            name: 'status',
                            label: 'Trạng thái',
                            options: schema.columns.status.list,
                        }"
                    />
                    <Field
                        v-model="form.published_at"
                        :field="{
                            type: 'date',
                            name: 'published_at',
                            label: 'Ngày xuất bản',
                        }"
                    />
                    <Field
                        v-model="form.is_featured"
                        :field="{
                            type: 'checkbox',
                            name: 'is_featured',
                            label: 'Nổi bật',
                        }"
                    />
                    <Field
                        v-model="form.image"
                        :field="{
                            type: 'file_upload',
                            name: 'image',
                            multiple: false,
                        }"
                    />
                    <Field
                        v-model="form.images"
                        :field="{
                            type: 'file_upload',
                            name: 'images',
                            multiple: true,
                            label: 'Danh sách ảnh',
                        }"
                    />
                    <Field
                        v-model="form.images_banner"
                        :field="{
                            label: 'Hình ảnh Banners',
                            type: 'file_upload',
                            name: 'images_banner',
                            multiple: true,
                        }"
                    />
                </div>
            </div>
        </template>
    </Form>
</template>
<script>
export default {
    props: ['item', 'schema'],
    data() {
        return {
            formData: {
                status: this.item.status ?? 'ACTIVE',
                date: this.item.date ?? null,
                ...this.item,
                images: this.item.images ?? [],
                images_banner: this.item.images_banner ?? [],
                type: 'ROOM',
                view_count: this.item.view_count ?? 0,
            },
        }
    },
    watch: {
        item() {
            this.formData = {
                status: this.item.status ?? 'ACTIVE',
                ...this.item,
                images: this.item.images ?? [],
                images_banner: this.item.images_banner ?? [],
                type: 'ROOM',
            }
        },
    },
}
</script>
