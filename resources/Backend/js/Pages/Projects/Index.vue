<template layout>
    <div>
        <Table
            :schema="schema"
            :columns="['id', 'image', 'title', 'is_featured', 'status', 'view_count', 'created_at', 'updated_at']"
        >
            <template #actions>
                <button
                    type="button"
                    class="p-button btn-outline-primary"
                    @click="openBannerDialog"
                >
                    <span class="mr-1.5">🖼️</span>
                    <span>Cài đặt Banner trang</span>
                </button>
            </template>
        </Table>

        <Dialog
            v-model:visible="showBannerDialog"
            header="Cài đặt Banner trang Dự án"
            :style="{ width: '600px', maxWidth: '95vw' }"
            :modal="true"
            :draggable="false"
        >
            <div class="space-y-4 pt-2">
                <Field
                    v-model="bannerForm.title"
                    :field="{
                        type: 'text',
                        name: 'title',
                        label: 'Tiêu đề banner',
                    }"
                />
                <Field
                    v-model="bannerForm.image"
                    :field="{
                        type: 'file_upload',
                        name: 'image',
                        label: 'Hình desktop (1920x600)',
                    }"
                />
                <Field
                    v-model="bannerForm.image_mobile"
                    :field="{
                        type: 'file_upload',
                        name: 'image_mobile',
                        label: 'Hình mobile (750x600)',
                    }"
                />
            </div>
            <template #footer>
                <div class="flex items-center justify-end space-x-2 mt-4">
                    <button
                        type="button"
                        class="p-button btn-secondary"
                        @click="showBannerDialog = false"
                    >
                        Hủy
                    </button>
                    <button
                        type="button"
                        class="p-button btn-primary"
                        :disabled="loading"
                        @click="saveBanner"
                    >
                        <span v-if="loading" class="mr-1">⏳</span>
                        <span>Lưu Banner</span>
                    </button>
                </div>
            </template>
        </Dialog>
    </div>
</template>

<script>
import Dialog from 'primevue/dialog'

export default {
    components: {
        Dialog,
    },

    props: ['schema', 'projectBanner'],

    data() {
        return {
            showBannerDialog: false,
            loading: false,
            bannerForm: {
                title: this.projectBanner?.title || 'DỰ ÁN',
                image: this.projectBanner?.image || null,
                image_mobile: this.projectBanner?.image_mobile || null,
            },
        }
    },

    watch: {
        projectBanner: {
            handler(val) {
                if (val) {
                    this.bannerForm = {
                        title: val.title || 'DỰ ÁN',
                        image: val.image || null,
                        image_mobile: val.image_mobile || null,
                    }
                }
            },
            deep: true,
        },
    },

    methods: {
        openBannerDialog() {
            if (this.projectBanner) {
                this.bannerForm = {
                    title: this.projectBanner.title || 'DỰ ÁN',
                    image: this.projectBanner.image || null,
                    image_mobile: this.projectBanner.image_mobile || null,
                }
            }
            this.showBannerDialog = true
        },

        saveBanner() {
            this.loading = true
            this.$inertia.post(
                this.route('admin.projects.banner.save'),
                this.bannerForm,
                {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.loading = false
                        this.showBannerDialog = false
                        this.$toast.add({
                            severity: 'success',
                            summary: 'Thành công',
                            detail: 'Cập nhật Banner trang Dự án thành công',
                            life: 3000,
                        })
                    },
                    onError: (errors) => {
                        this.loading = false
                        const msg =
                            errors && Object.values(errors).length > 0
                                ? Object.values(errors)[0]
                                : 'Không thể lưu banner, vui lòng thử lại'
                        this.$toast.add({
                            severity: 'error',
                            summary: 'Lỗi',
                            detail: msg,
                            life: 3000,
                        })
                    },
                }
            )
        },
    },
}
</script>
