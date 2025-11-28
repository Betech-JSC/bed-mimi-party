<template>
    <div v-if="item.slug" class="space-y-3 group">
        <Link
            :href="
                route('products.show', {
                    slug: item.slug,
                })
            "
            class="aspect-w-1 aspect-h-1 block relative overflow-hidden"
        >
            <JPicture
                :src="item.image?.url || '/assets/images/demo/image-product.jpg'"
                :alt="item.title"
                wrapperClass="picture-cover"
                class="w-full h-full object-cover lg:group-hover:scale-105 duration-300 ease-in-out"
            />
        </Link>
        <div class="space-y-0.5">
            <Link
                :href="
                    route('products.show', {
                        slug: item.slug,
                    })
                "
                class="title-3 text-gray-900 lg:group-hover:text-primary-800 duration-300 ease-in-out"
            >
                {{ item.title }}
            </Link>
            <div class="body-2 text-gray-700">
                {{ new Intl.NumberFormat('vi-VN').format(item.price) + ' VNĐ' }}
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
}
</script>
