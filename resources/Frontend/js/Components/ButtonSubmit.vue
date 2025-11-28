<template>
    <button class="relative group w-full mx-auto" :disabled="disabled">
        <svg width="99.9%" height="48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect
                x="0.5"
                y="0.5"
                width="99.9%"
                height="47"
                rx="23.5"
                fill="url(#paint0_linear_14019_385)"
                fill-opacity="0.3"
            />
            <rect x="0.5" y="0.5" width="99.9%" height="47" rx="23.5" stroke="url(#paint1_linear_14019_385)" />
            <defs>
                <linearGradient
                    id="paint0_linear_14019_385"
                    x1="7.96377"
                    y1="2.5"
                    x2="396.306"
                    y2="205.754"
                    gradientUnits="userSpaceOnUse"
                >
                    <stop stop-opacity="0" />
                    <stop offset="1" stop-color="white" />
                </linearGradient>
                <linearGradient
                    id="paint1_linear_14019_385"
                    x1="0"
                    y1="0"
                    x2="388.245"
                    y2="204.846"
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
    </button>
</template>

<script>
import Star from './Icons/Star.vue'

export default {
    props: {
        disabled: {
            type: Boolean,
            default: false,
        },
    },
    components: { Star },
}
</script>
