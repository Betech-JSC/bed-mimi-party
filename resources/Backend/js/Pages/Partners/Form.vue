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
                            label: 'Website đối tác (Link)',
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
                        v-model="form.position"
                        :field="{
                            type: 'number',
                            name: 'position',
                            label: 'Thứ tự hiển thị',
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
                            label: 'Ảnh đại diện',
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
                ...this.item,
                link: this.item.link ?? null,
                status: this.item.status ?? 'ACTIVE',
                position: this.item.position ?? 0,
                is_featured: this.item.is_featured ?? 0,
                image: this.item.image ?? null,
                images: this.item.images ?? [],
                banner: this.item.banner ?? null,
                type: 'PARTNER',
                view_count: this.item.view_count ?? 0,
            },
        }
    },
    watch: {
        item() {
            this.formData = {
                ...this.item,
                link: this.item.link ?? null,
                status: this.item.status ?? 'ACTIVE',
                position: this.item.position ?? 0,
                is_featured: this.item.is_featured ?? 0,
                image: this.item.image ?? null,
                images: this.item.images ?? [],
                banner: this.item.banner ?? null,
                type: 'PARTNER',
                view_count: this.item.view_count ?? 0,
            }
        },
    },
}
</script>

