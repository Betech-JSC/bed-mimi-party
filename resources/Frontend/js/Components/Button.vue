<template>
    <div class="relative group w-max">
        <svg width="204" height="48" viewBox="0 0 204 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect
                x="0.5"
                y="0.5"
                width="203"
                height="47"
                rx="23.5"
                fill="url(#paint0_linear_13970_579)"
                fill-opacity="0.3"
            />
            <rect x="0.5" y="0.5" width="203" height="47" rx="23.5" stroke="url(#paint1_linear_13970_579)" />
            <defs>
                <linearGradient
                    id="paint0_linear_13970_579"
                    x1="3.44928"
                    y1="2.5"
                    x2="207.251"
                    y2="48.7"
                    gradientUnits="userSpaceOnUse"
                >
                    <stop stop-opacity="0" />
                    <stop offset="1" stop-color="white" />
                </linearGradient>
                <linearGradient
                    id="paint1_linear_13970_579"
                    x1="0"
                    y1="0"
                    x2="204.3"
                    y2="46.6873"
                    gradientUnits="userSpaceOnUse"
                >
                    <stop stop-color="white" stop-opacity="0.3" />
                    <stop offset="1" stop-color="white" />
                </linearGradient>
            </defs>
        </svg>
        <div class="absolute inset-0 w-full h-full flex items-center justify-center">
            <div class="flex items-center gap-2.5 text-white lg:group-hover:text-primary duration-300 ease-in-out">
                <div class="lg:group-hover:rotate-180 duration-300 ease-in-out">
                    <Star />
                </div>
                <div class="title-3 text-center"><slot>Button</slot></div>
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
