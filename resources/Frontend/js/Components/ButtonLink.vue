<template>
    <div class="relative group w-max cursor-pointer">
        <div class="w-full h-full flex items-center justify-center">
            <div class="flex items-center gap-2.5 text-white lg:group-hover:text-primary duration-300 ease-in-out">
                <div class="lg:group-hover:rotate-180 duration-300 ease-in-out">
                    <Star />
                </div>
                <div class="title-3 text-center border-b border-white lg:group-hover:border-primary duration-300 ease-in-out"><slot>Button</slot></div>
            </div>
        </div>
    </div>
</template>

<script>
import Star from './Icons/Star.vue'

export default {
    components: { Star },
}
</script>
