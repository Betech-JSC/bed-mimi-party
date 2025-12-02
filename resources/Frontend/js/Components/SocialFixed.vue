<template>
    <div class="fixed bottom-[100px] xl:right-[26px] right-4 z-[100] space-y-3 md:space-y-5">
        <a
            :href="`tel:${$page.props.global.general_phone || tt('032 9831 319')}`"
            rel="noopener noreferrer nofollow"
            class="relative w-14 h-14 flex items-center justify-center social-style"
        >
            <div class="glass-circle"></div>
            <div class="absolute w-6 h-6 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <JPicture src="/assets/images/image-phone.png" alt="image phone" class="w-full h-full object-cover" />
            </div>
        </a>
        <a
            :href="this.$page.props.global.general_message_zalo_link ?? 'https://zalo.me/0329831319'"
            target="_blank"
            rel="noopener noreferrer nofollow"
            class="relative w-14 h-14 flex items-center justify-center social-style"
        >
            <div class="glass-circle"></div>
            <div class="absolute w-8 h-8 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <JPicture src="/assets/images/image-zalo.png" alt="image zalo" class="w-full h-full" />
            </div>
        </a>
        <a
            :href="this.$page.props.global.general_message_fb_link ?? 'https://www.facebook.com/mimipartyy'"
            target="_blank"
            rel="noopener noreferrer nofollow"
            class="relative w-14 h-14 flex items-center justify-center social-style"
        >
            <div class="glass-circle"></div>
            <div class="absolute w-7 h-7 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <JPicture src="/assets/images/image-facebook.png" alt="image facebook" class="w-full h-full" />
            </div>
        </a>
         <a
            href="mailto:mpevent.entertainment@gmail.com"
            target="_blank"
            rel="noopener noreferrer nofollow"
            class="relative w-14 h-14 flex items-center justify-center social-style"
        >
            <div class="glass-circle"></div>
            <div class="absolute w-7 h-7 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <JPicture src="/assets/images/image-mail.png" alt="image mail" class="w-full h-full" />
            </div>
        </a>
    </div>
</template>
<script>
export default {}
</script>
