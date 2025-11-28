<template>
    <div v-show="links && links.length > 3">
        <div class="flex flex-wrap items-center justify-center space-x-3">
            <template v-for="(link, key) in links">
                <div v-if="link.label == 'Previous' || link.label == 'Next'" :key="key">
                    <Link
                        v-if="link.url"
                        :href="link.url"
                        class="w-[30px] h-[30px] lg:w-[40px] lg:h-[40px] flex items-center justify-center rotate-180 cursor-pointer lg:hover:text-primary-800 duration-300 ease-in-out"
                    >
                        <svg
                            :class="{
                                'transform': link.label == 'Previous',
                            }"
                            width="20"
                            height="20"
                            viewBox="0 0 20 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M15.8327 10H4.16602M4.16602 10L9.99935 15.8334M4.16602 10L9.99935 4.16669"
                                stroke="currentColor"
                                stroke-width="1.67"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </Link>
                    <div
                        v-else
                        class="w-[30px] h-[30px] lg:w-[40px] lg:h-[40px] flex items-center justify-center rotate-0 text-gray-400"
                    >
                        <svg
                            :class="{
                                transform: link.label == 'Next',
                            }"
                            width="20"
                            height="20"
                            viewBox="0 0 20 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M15.8327 10H4.16602M4.16602 10L9.99935 15.8334M4.16602 10L9.99935 4.16669"
                                stroke="currentColor"
                                stroke-width="1.67"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                </div>
                <div v-else :key="key + 1">
                    <div
                        v-if="link.active"
                        class="body-2 w-[30px] h-[30px] lg:w-[40px] lg:h-[40px] border flex bg-primary-700 border-primary-700 text-white items-center justify-center rounded-full"
                    >
                        <div>
                            {{ link.label }}
                        </div>
                    </div>
                    <Link
                        v-else
                        class="body-2 w-[30px] h-[30px] lg:w-[40px] lg:h-[40px] border flex text-gray-700 rounded-full lg:hover:bg-primary-700 lg:hover:border-primary-700 duration-300 ease-in-out lg:hover:text-white items-center justify-center"
                        :href="link.url"
                    >
                        <div>
                            {{ link.label }}
                        </div>
                    </Link>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        links: Array,
    },
}
</script>
