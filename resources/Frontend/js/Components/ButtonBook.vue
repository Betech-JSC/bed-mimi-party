<template>
    <div class="relative group w-max" :disabled="disabled">
        <svg width="113" height="30" viewBox="0 0 113 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect
                x="0.5"
                y="0.5"
                width="112"
                height="29"
                rx="14.5"
                fill="url(#paint0_linear_12198_590)"
                fill-opacity="0.4"
            />
            <rect x="0.5" y="0.5" width="112" height="29" rx="14.5" stroke="url(#paint1_linear_12198_590)" />
            <defs>
                <linearGradient
                    id="paint0_linear_12198_590"
                    x1="1.91063"
                    y1="1.5625"
                    x2="115.997"
                    y2="24.4836"
                    gradientUnits="userSpaceOnUse"
                >
                    <stop stop-opacity="0.9" />
                    <stop offset="1" stop-color="white" />
                </linearGradient>
                <linearGradient
                    id="paint1_linear_12198_590"
                    x1="0"
                    y1="0"
                    x2="114.384"
                    y2="23.1667"
                    gradientUnits="userSpaceOnUse"
                >
                    <stop stop-color="white" stop-opacity="0.3" />
                    <stop offset="1" stop-color="white" />
                </linearGradient>
            </defs>
        </svg>

        <div class="absolute inset-0 w-full h-full flex items-center justify-center">
            <div class="flex items-center gap-2.5 text-white lg:group-hover:text-primary duration-300 ease-in-out">
                <div class="label-3 text-center"><slot>Button</slot></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        disabled: {
            type: Boolean,
            default: false,
        },
    },
}
</script>
