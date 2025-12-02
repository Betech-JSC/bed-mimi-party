<template>
    <div
        class="fixed w-14 h-14 flex items-center justify-center xl:bottom-[28px] bottom-5 xl:right-[26px] right-4 z-[100] duration-500 ease-in-out cursor-pointer social-style"
        :class="isShowBtn ? 'translate-y-0' : 'translate-y-[200px]'"
        @click="scrollToTop"
    >
        <div class="glass-circle"></div>
        <div class="absolute w-8 h-8 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <IconArrowUp class="text-white -rotate-90" />
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isShowBtn: false,
        }
    },
    mounted() {
        const self = this
        window.addEventListener('scroll', function () {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 500) {
                self.isShowBtn = true
            } else {
                self.isShowBtn = false
            }
        })
    },
    methods: {
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            })
        },
    },
}
</script>
