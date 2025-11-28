<template>
    <div v-if="items && items.length" class="breadcrumbs line-clamp-1 body-2 py-[12px]">
        <div class="flex items-center gap-x-2">
            <a
                class="duration-300 ease-in-out"
                :class="
                    isWhite ? 'text-white/70 lg:hover:text-white' : 'text-primary-700 lg:hover:text-primary-900'
                "
                :href="route('home')"
                >{{ tt('Trang chủ') }}</a
            >
            <template v-for="(item, index) in items" :key="index">
                <template v-if="item.link">
                    <span class="separator" :class="isWhite ? 'text-white' : 'text-gray-900'">
                        <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.29263 7.35476L4.39862 4.25799C4.43548 4.22112 4.46154 4.18118 4.47677 4.13817C4.49226 4.09516 4.5 4.04908 4.5 3.99992C4.5 3.95077 4.49226 3.90469 4.47677 3.86168C4.46154 3.81866 4.43548 3.77873 4.39862 3.74186L1.29263 0.635868C1.20661 0.549847 1.09908 0.506836 0.970046 0.506836C0.841014 0.506836 0.730415 0.552919 0.638249 0.645085C0.546083 0.737251 0.5 0.844778 0.5 0.967665C0.5 1.09055 0.546083 1.19808 0.638249 1.29025L3.34793 3.99992L0.638249 6.7096C0.552227 6.79562 0.509217 6.90155 0.509217 7.02739C0.509217 7.15347 0.5553 7.2626 0.647465 7.35476C0.739631 7.44693 0.847158 7.49301 0.970046 7.49301C1.09293 7.49301 1.20046 7.44693 1.29263 7.35476Z"
                                fill="currentColor"
                            />
                        </svg>
                    </span>
                    <a :class="isWhite ? 'text-white/70 lg:hover:text-white' : 'text-primary-700 lg:hover:text-primary-900'" :href="item.link">{{ item.title }}</a>
                </template>
                <template v-else>
                    <span class="separator" :class="isWhite ? 'text-white' : 'text-gray-900'">
                        <svg width="5" height="8" viewBox="0 0 5 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.29263 7.35476L4.39862 4.25799C4.43548 4.22112 4.46154 4.18118 4.47677 4.13817C4.49226 4.09516 4.5 4.04908 4.5 3.99992C4.5 3.95077 4.49226 3.90469 4.47677 3.86168C4.46154 3.81866 4.43548 3.77873 4.39862 3.74186L1.29263 0.635868C1.20661 0.549847 1.09908 0.506836 0.970046 0.506836C0.841014 0.506836 0.730415 0.552919 0.638249 0.645085C0.546083 0.737251 0.5 0.844778 0.5 0.967665C0.5 1.09055 0.546083 1.19808 0.638249 1.29025L3.34793 3.99992L0.638249 6.7096C0.552227 6.79562 0.509217 6.90155 0.509217 7.02739C0.509217 7.15347 0.5553 7.2626 0.647465 7.35476C0.739631 7.44693 0.847158 7.49301 0.970046 7.49301C1.09293 7.49301 1.20046 7.44693 1.29263 7.35476Z"
                                fill="currentColor"
                            />
                        </svg>
                    </span>
                    <span :class="isWhite ? 'text-white' : 'text-gray-900'" v-if="!ish1">{{ item.title }}</span>
                    <h1 class="inline" :class="isWhite ? 'text-white' : 'text-gray-900'" v-else>{{ item.title }}</h1>
                </template>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    props: ['items', 'ish1', 'isWhite'],
}
</script>

<style lang="scss" scoped>
.breadcrumbs {
    @apply space-x-[20px];
    > *:not(:last-child) {
        @apply relative;
        &::after {
            content: '';
            pointer-events: none;
            @apply absolute top-0 right-[-11px] w-[4px]  transform translate-x-[50%] h-full bg-no-repeat bg-center;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNCIgaGVpZ2h0PSI4IiB2aWV3Qm94PSIwIDAgNCA4IiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cGF0aCBkPSJNMC43OTI2MjcgNy43ODY4OUwzLjg5ODYyIDQuNjkwMTJDMy45MzU0OCA0LjY1MzI1IDMuOTYxNTQgNC42MTMzMSAzLjk3Njc3IDQuNTcwM0MzLjk5MjI2IDQuNTI3MjkgNCA0LjQ4MTIxIDQgNC40MzIwNUM0IDQuMzgyOSAzLjk5MjI2IDQuMzM2ODEgMy45NzY3NyA0LjI5MzhDMy45NjE1NCA0LjI1MDc5IDMuOTM1NDggNC4yMTA4NSAzLjg5ODYyIDQuMTczOTlMMC43OTI2MjcgMS4wNjhDMC43MDY2MDUgMC45ODE5NzYgMC41OTkwNzggMC45Mzg5NjUgMC40NzAwNDYgMC45Mzg5NjVDMC4zNDEwMTQgMC45Mzg5NjUgMC4yMzA0MTUgMC45ODUwNDggMC4xMzgyNDkgMS4wNzcyMUMwLjA0NjA4MyAxLjE2OTM4IDAgMS4yNzY5MSAwIDEuMzk5NzlDMCAxLjUyMjY4IDAuMDQ2MDgzIDEuNjMwMjEgMC4xMzgyNDkgMS43MjIzOEwyLjg0NzkzIDQuNDMyMDVMMC4xMzgyNDkgNy4xNDE3M0MwLjA1MjIyNzUgNy4yMjc3NSAwLjAwOTIxNjU1IDcuMzMzNjggMC4wMDkyMTY1NSA3LjQ1OTUyQzAuMDA5MjE2NTUgNy41ODU2IDAuMDU1Mjk5NSA3LjY5NDczIDAuMTQ3NDY1IDcuNzg2ODlDMC4yMzk2MzEgNy44NzkwNiAwLjM0NzE1OCA3LjkyNTE0IDAuNDcwMDQ2IDcuOTI1MTRDMC41OTI5MzQgNy45MjUxNCAwLjcwMDQ2MSA3Ljg3OTA2IDAuNzkyNjI3IDcuNzg2ODlaIiBmaWxsPSIjMzQ0MDU0Ii8+Cjwvc3ZnPgo=');
        }
    }

    > *:not(:last-child) {
        @apply relative text-primary-700 lg:hover:text-primary-900 duration-300 ease-in-out;
    }

    &.is-background {
        > *:not(:last-child) {
            &::after {
                background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNCIgaGVpZ2h0PSI4IiB2aWV3Qm94PSIwIDAgNCA4IiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cGF0aCBkPSJNMC43OTI2MjcgNy4zNTQ3NkwzLjg5ODYyIDQuMjU3OTlDMy45MzU0OCA0LjIyMTEyIDMuOTYxNTQgNC4xODExOCAzLjk3Njc3IDQuMTM4MTdDMy45OTIyNiA0LjA5NTE2IDQgNC4wNDkwOCA0IDMuOTk5OTJDNCAzLjk1MDc3IDMuOTkyMjYgMy45MDQ2OSAzLjk3Njc3IDMuODYxNjhDMy45NjE1NCAzLjgxODY2IDMuOTM1NDggMy43Nzg3MyAzLjg5ODYyIDMuNzQxODZMMC43OTI2MjcgMC42MzU4NjhDMC43MDY2MDUgMC41NDk4NDcgMC41OTkwNzggMC41MDY4MzYgMC40NzAwNDYgMC41MDY4MzZDMC4zNDEwMTQgMC41MDY4MzYgMC4yMzA0MTUgMC41NTI5MTkgMC4xMzgyNDkgMC42NDUwODVDMC4wNDYwODMgMC43MzcyNTEgMCAwLjg0NDc3OCAwIDAuOTY3NjY1QzAgMS4wOTA1NSAwLjA0NjA4MyAxLjE5ODA4IDAuMTM4MjQ5IDEuMjkwMjVMMi44NDc5MyAzLjk5OTkyTDAuMTM4MjQ5IDYuNzA5NkMwLjA1MjIyNzUgNi43OTU2MiAwLjAwOTIxNjU1IDYuOTAxNTUgMC4wMDkyMTY1NSA3LjAyNzM5QzAuMDA5MjE2NTUgNy4xNTM0NyAwLjA1NTI5OTUgNy4yNjI2IDAuMTQ3NDY1IDcuMzU0NzZDMC4yMzk2MzEgNy40NDY5MyAwLjM0NzE1OCA3LjQ5MzAxIDAuNDcwMDQ2IDcuNDkzMDFDMC41OTI5MzQgNy40OTMwMSAwLjcwMDQ2MSA3LjQ0NjkzIDAuNzkyNjI3IDcuMzU0NzZaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4K');
            }
        }
        > a:not(:last-child) {
            @apply text-white opacity-100;
        }
        > span:not(:last-child) {
            @apply text-white opacity-100;
        }
        span {
            @apply text-white;
        }
    }
}
</style>
