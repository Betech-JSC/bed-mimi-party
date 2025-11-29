<template>
    <div class="relative inset-x-0 overflow-hidden py-10">
        <div class="marquee">
            <div class="marquee-element">
                <div class="marquee-bar" v-for="(item, index) in marqueeList" :key="index">
                    <div
                        v-for="(itemText, indexText) in item"
                        :key="indexText"
                        class="flex items-center justify-center headline-2 gap-2 text-white font-extrabold"
                    >
                        <span>{{ itemText }}</span>
                        <span>-</span>
                    </div>
                </div>      
            </div>
                      <div class="absolute top-0 left-0 overlay-left"></div>
                <div class="absolute top-0 right-0 overlay-right"></div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        marquee: {
            type: Array,
            default: [],
        },
        loopTimes: {
            type: Number,
            default: 4,
        },
    },
    data() {
        return {
            marqueeList: [],
        }
    },
    mounted() {
        for (let i = 0; i < this.loopTimes; i++) {
            this.marqueeList.push(this.marquee)
        }
    },
}
</script>
<style lang="scss" scoped>
.marquee {
    @apply w-full overflow-hidden relative skew-y-3;
}
.marquee-bar {
    width: 50%;
    @apply flex items-center w-max gap-2 pr-2 bg-primary-700 py-4;
}
.marquee-element {
    @apply relative overflow-hidden flex w-max;
    animation-name: marquee;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    animation-duration: 18s;
    &.normal {
        animation-direction: normal;
    }
    &.reverse {
        animation-direction: reverse;
    }
}

.marquee-element:hover {
    animation-play-state: paused;
    -webkit-animation-play-state: paused;
    -moz-animation-play-state: paused;
    -o-animation-play-state: paused;
    -ms-animation-play-state: paused;
}
@keyframes marquee {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-1036px);
        @screen lg {
            transform: translateX(-2072px);
        }
    }
}

.overlay-left {
    background: linear-gradient(-90deg, #73737300 0%, #000000 100%, rgba(115, 115, 115, 0) 0%);
    @apply w-full h-full max-w-[50%];
}

.overlay-right {
    background: linear-gradient(90deg, rgba(115, 115, 115, 0) 0%, #000000 100%, rgba(115, 115, 115, 0) 0%);
    @apply w-full h-full max-w-[50%];
}

// .marquee-card {
//     flex: 0 0 300px;
//     @apply w-[387px] h-[258px] xl:mx-4 md:mx-3 mx-2 duration-150;
// }

// @media screen and (min-width: 1024px) {
//     .marquee-card {
//         flex: 0 0 387px;
//     }
// }
</style>
