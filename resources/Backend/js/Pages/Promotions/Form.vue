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
                        v-model="form.link"
                        :field="{
                            type: 'text',
                            name: 'link',
                            label: 'Link Video',
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
                        v-model="form.date"
                        :field="{
                            type: 'date',
                            name: 'date',
                            label: 'Ngày sự kiện',
                        }"
                    />
                    <Field
                        v-model="form.time"
                        :field="{
                            type: 'time',
                            name: 'time',
                            label: 'Giờ',
                        }"
                    />
                    <Field
                        v-model="form.location"
                        :field="{
                            type: 'text',
                            name: 'location',
                            label: 'Địa điểm',
                        }"
                    />
                    <Field
                        v-model="form.weekday"
                        :field="{
                            type: 'radio_list',
                            name: 'weekday',
                            label: 'Ngày trong tuần',
                            options: [
                                { id: 'Monday', label: 'Thứ 2' },
                                { id: 'Tuesday', label: 'Thứ 3' },
                                { id: 'Wednesday', label: 'Thứ 4' },
                                { id: 'Thursday', label: 'Thứ 5' },
                                { id: 'Friday', label: 'Thứ 6' },
                                { id: 'Saturday', label: 'Thứ 7' },
                                { id: 'Sunday', label: 'Chủ nhật' },
                            ],
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
                weekend: this.item.weekend ?? 'Monday',
                ...this.item,
                images: this.item.images ?? [],
                images_banner: this.item.images_banner ?? [],
                type: 'PROMOTION',
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
                weekend: this.item.weekend ?? 'Monday',
                images_banner: this.item.images_banner ?? [],
                type: 'PROMOTION',
            }
        },
    },
}
</script>
