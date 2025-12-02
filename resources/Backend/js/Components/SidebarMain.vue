<template>
    <span class="hidden">
        {{ $page.props.route.name }}
    </span>
    <Link
        v-if="can('admin.projects.index')"
        :href="route('admin.projects.index')"
        :class="{ active: isUrl('admin.projects.*') }"
        class="item"
    >
        <ph-newspaper-clipping-light />
        <span>{{ tt('models.table_list.projects') }}</span>
    </Link>
    <Link
        v-if="can('admin.posts.index')"
        :href="route('admin.posts.index')"
        :class="{ active: isUrl('admin.posts.*') }"
        class="item"
    >
        <ph-newspaper-clipping-light />
        <span>{{ tt('models.table_list.posts') }}</span>
    </Link>
        <Link
        v-if="can('admin.customers.index')"
        :href="route('admin.customers.index')"
        :class="{ active: isUrl('admin.customers.*') }"
        class="item"
    >
        <ph-newspaper-clipping-light />
        <span>{{ tt('models.table_list.customers') }}</span>
    </Link>
    <Link
        v-if="can('admin.services.index')"
        :href="route('admin.services.index')"
        :class="{ active: isUrl('admin.services.*') }"
        class="item"
    >
        <ph-newspaper-clipping-light />
        <span>{{ tt('models.table_list.services') }}</span>
    </Link>
    <Link
        v-if="can('admin.contacts.index')"
        :href="route('admin.contacts.index')"
        :class="{ active: isUrl('admin.contacts.*') }"
        class="item"
    >
        <material-symbols:connect-without-contact />
        <span>{{ tt('models.table_list.contacts') }}</span>
        <span class="badge badge-danger" v-if="newContact">{{ newContact }}</span>
    </Link>

    <Link
        v-if="can('admin.sliders.index')"
        :href="route('admin.sliders.index')"
        :class="{ active: isUrl('admin.sliders.*') }"
        class="item"
    >
        <bi:sliders2 />
        <span>{{ tt('models.table_list.sliders') }}</span>
    </Link>
</template>

<script>
export default {
    computed: {
        newContact() {
            return this.$page.props.data.new_contact_count
        },
        newApply() {
            return this.$page.props.data.new_apply_count
        },
        newOrder() {
            return this.$page.props.data.new_order_count
        },
    },
}
</script>
<style scoped>
.badge {
    @apply px-2 py-1 text-xs font-medium rounded;
}
.badge-success {
    @apply text-green-700 bg-green-200;
}
.badge-danger {
    @apply text-red-600 bg-red-200;
}
</style>
