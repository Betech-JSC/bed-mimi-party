<template>
    <Link href="/" class="relative duration-300 ease-in-out block card-room">
        <div class="image-wrapper aspect-w-16 aspect-h-9 relative">
            <JPicture
                :src="item.image.url"
                :alt="item.image.alt || item.title || 'image room'"
                class="w-full h-full object-cover"
            />
        </div>
    </Link>
</template>

<script>
export default {
    props: ['item'],
}
</script>
<style lang="scss" scoped>
@keyframes shadowLoop {
    0% {
        box-shadow: 0px 0px 12px rgba(154, 188, 255, 0.55);
    }
    25% {
        box-shadow: 10px 0 20px rgba(154, 188, 255, 0.55);
    }
    50% {
        box-shadow: 0 -10px 20px rgba(154, 188, 255, 0.55);
    }
    75% {
        box-shadow: -10px 0 20px rgba(154, 188, 255, 0.55);
    }
    100% {
        box-shadow: 0px 0px 12px rgba(154, 188, 255, 0.55);
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
    @apply relative border-none cursor-pointer;
    transition: 0.3s;

    &:hover {
        .image-wrapper {
            @apply relative z-0;
            &::before {
                @apply content-[''] absolute inset-0 z-[-1];
                box-shadow: 0px 0px 12px rgba(154, 188, 255, 0.55);
                animation: shadowLoop 4s linear infinite;
            }
        }
        &::before {
            @apply content-[''] absolute inset-[-2px] p-0.5;
            background: conic-gradient(
                from var(--d, 0deg),
                #74a3ff,
                #0000 30deg 120deg,
                #74a3ff 150deg 180deg,
                #0000 210deg 300deg,
                #74a3ff 330deg
            );
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: intersect;
        }
        &::after {
            @apply content-[''] absolute inset-[-90px] opacity-5 blur-[60px];
            background: radial-gradient(60px at left 150px top 120px, #74a3ff 98%, #0000),
                radial-gradient(60px at right 150px bottom 120px, #74a3ff 98%, #0000);
            transform: rotate(3600deg);
            transition: 0.5s, 60s linear --d;
        }
        &::before,
        &::after {
            transition: 0.5s, 99999s 99999s transform, 99999s 99999s --d;
        }
        &::after {
            transform: rotate(3600deg);
            transition: 0.5s, 60s linear transform;
        }
        &::before {
            --d: 3600deg;
            transition: 0.5s, 60s linear --d;
        }
    }
}
</style>
