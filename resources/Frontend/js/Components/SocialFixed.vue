<template>
    <div class="fixed bottom-[80px] xl:right-[26px] right-4 z-[100] space-y-3 md:space-y-5">
        <a
            :href="this.$page.props.global.general_message_fb_link ?? ''"
            target="_blank"
            rel="noopener noreferrer nofollow"
            class="w-10 h-10 rounded-full flex items-center justify-center"
        >
            <JPicture src="/assets/images/image-facebook.png" alt="image facebook" class="w-full h-full object-cover" />
        </a>
        <Link
            :href="route('promotions.index')"
            class="w-10 h-10 rounded-full flex items-center justify-center"
        >
            <JPicture src="/assets/images/image-calendar.png" alt="image calendar" class="w-full h-full object-cover" />
        </Link>
        <a
            :href="`tel:${$page.props.global.general_phone || tt('090 678 35 78')}`"
            rel="noopener noreferrer nofollow"
            class="w-10 h-10 rounded-full flex items-center justify-center"
        >
            <JPicture src="/assets/images/image-phone.png" alt="image phone" class="w-full h-full object-cover" />
        </a>
        <a
            href="https://maps.app.goo.gl/eJXYvvCT7VAgvMLbA"
            rel="noopener noreferrer nofollow"
            target="_blank"
            class="w-10 h-10 rounded-full flex items-center justify-center"
        >
            <JPicture src="/assets/images/image-address.png" alt="image address" class="w-full h-full object-cover" />
        </a>
           <a
            href="https://www.tiktok.com/@90s.house.privatelounge"
            rel="noopener noreferrer nofollow"
            target="_blank"
            class="w-10 h-10 rounded-full flex items-center justify-center"
        >
            <JPicture src="/assets/images/image-tiktok.png" alt="image tiktok" class="w-full h-full object-cover" />
        </a>
    </div>
</template>
<script>
export default {}
</script>
