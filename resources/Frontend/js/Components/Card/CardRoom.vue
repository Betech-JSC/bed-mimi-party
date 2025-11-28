<template>
    <Link
        :href="
            route('rooms.show', {
                slug: item.slug ?? '',
            })
        "
        class="relative duration-300 ease-in-out block card-room"
    >
        <div class="image-wrapper aspect-w-7 aspect-h-5 relative">
            <img
                :src="item.image.url"
                :alt="item.image.alt || item.title || 'image room'"
                class="w-full h-full object-cover"
            />
        </div>
        <div class="absolute bottom-0 left-0 pb-2 md:pb-4 px-3 md:px-5 w-full">
            <div class="max-md:text-[14px] headline-2 text-white">{{ item.title }}</div>
        </div>
    </Link>
</template>

<script>
export default {
    props: ['item'],
}
</script>

<style scoped>
.image-wrapper {
    position: relative;
    z-index: 0;
}

.image-wrapper::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: -1;
    box-shadow: 0 10px 20px rgba(217, 45, 32, 0.66);
    animation: shadowLoop 4s linear infinite; /* Continuous loop with 4s duration */
}

@keyframes shadowLoop {
    0% {
        box-shadow: 0 10px 20px rgba(217, 45, 32, 0.66); /* Bottom shadow */
    }
    25% {
        box-shadow: 10px 0 20px rgba(217, 45, 32, 0.66); /* Right shadow */
    }
    50% {
        box-shadow: 0 -10px 20px rgba(217, 45, 32, 0.66); /* Top shadow */
    }
    75% {
        box-shadow: -10px 0 20px rgba(217, 45, 32, 0.66); /* Left shadow */
    }
    100% {
        box-shadow: 0 10px 20px rgba(217, 45, 32, 0.66); /* Back to bottom */
    }
}

@media (min-width: 1024px) {
    .image-wrapper::before {
        animation: shadowLoop 4s linear infinite; /* Ensure continuous animation on larger screens */
    }
}

@property --d {
    syntax: '<angle>';
    inherits: true;
    initial-value: 0deg;
}
.card-room {
    background: none;
    border: none;
    position: relative;
    z-index: 0;
    transition: 0.3s;
    cursor: pointer;
}
.card-room:before {
    content: '';
    position: absolute;
    inset: -2px;
    padding: 2px;
    background: conic-gradient(
        from var(--d, 0deg),
        #eb5128,
        #0000 30deg 120deg,
        #eb5128 150deg 180deg,
        #0000 210deg 300deg,
        #eb5128 330deg
    );
    -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask-composite: xor;
    mask-composite: intersect;
}
.card-room:after {
    content: '';
    position: absolute;
    inset: -90px;
    background: radial-gradient(60px at left 150px top 120px, #eb5128 98%, #0000),
        radial-gradient(60px at right 150px bottom 120px, #eb5128 98%, #0000);
    filter: blur(60px);
    opacity: 0.5;
    transform: rotate(3600deg);
    transition: 0.5s, 60s linear --d;
}

.card-room:before,
.card-room:after {
    transition: 0.5s, 99999s 99999s transform, 99999s 99999s --d;
}
/* .card-room:hover {
    box-shadow: 0 0 0 1px #666;
} */

.card-room:hover:after {
    transform: rotate(3600deg);
    transition: 0.5s, 60s linear transform;
}
.card-room:hover:before {
    --d: 3600deg;
    transition: 0.5s, 60s linear --d;
}
.card-room:hover:before {
    background-color: #222;
}
</style>
