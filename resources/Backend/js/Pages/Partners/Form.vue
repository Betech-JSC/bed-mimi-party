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
               
                </div>
            </div>
            <SeoFields :modelValue="form" @update:modelValue="form = $event" />
        </template>
        <template #aside="{ form }">
            <div class="card">
                <div class="card-body">
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
                status: this.item.status ?? 'ACTIVE',
                image: this.item.image ?? null,
                images: this.item.images ?? [],
                banner: this.item.banner ?? null,
                type: 'PARTNER',
                view_count: 0,
                ...this.item,
            },
        }
    },
    watch: {
        item() {
            this.formData = {
                status: this.item.status ?? 'ACTIVE',
                image: this.item.image ?? null,
                images: this.item.images ?? [],
                banner: this.item.banner ?? null,
                type: 'PARTNER',
                view_count: 0,
                ...this.item,
            }
        },
    },
}
</script>

