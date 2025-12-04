<template>
    <section class="md:py-16 py-12 xl:py-20 relative">
        <div class="absolute inset-0">
            <JPicture src="/assets/images/home/bg-mission-value.jpg" alt="background mission value"
                class="w-full h-full" />
        </div>
        <div class="relative">
            <div class="container space-y-12 md:space-y-16 xl:space-y-20">
                <div class="md:space-y-8 space-y-6 xl:space-y-12">
                    <div class="space-y-3">
                        <div class="max-w-[250px] md:max-w-[320px] lg:max-w-[442px] max-h-[97px] mx-auto">
                            <JPicture src="/assets/images/logo-mini-party-effect.png" alt="logo"
                                class="w-full h-full mix-blend-plus-lighter" />
                        </div>
                        <div class="title-4 text-white text-center" v-html="$page.props.global.the_venue_content">
                        </div>
                    </div>
                    <div v-if="!isHome" class="grid md:grid-cols-3 xl:px-20">
                        <div v-for="(itemValue, indexValue) in values" :key="indexValue"
                            class="space-y-3 p-3 md:p-4 xl:p-6 lg:hover:bg-white/5 border border-transparent lg:hover:border-white/50 duration-300 ease-in-out md:min-h-[332px]">
                            <div class="h-11" :class="indexValue === 0 ? 'w-14' : 'w-11'">
                                <JPicture :src="itemValue.image.url" :alt="itemValue.image.alt || itemValue.title"
                                    class="w-full h-full mix-blend-plus-lighter" />
                            </div>
                            <h3 class="title-2 font-bold uppercase text-white">{{ itemValue.title }}</h3>
                            <div class="title-4 text-white text-justify">{{ itemValue.description }}</div>
                        </div>
                    </div>
                </div>
               <div>
                <div v-if="$page.props.global.the_homepage_content || $page.props.global.the_about_content" class="title-1 font-bold text-white text-center max-w-[726px] w-full mx-auto" v-html="isHome ? $page.props.global.the_homepage_content : $page.props.global.the_about_content"></div>
                <div v-else class="title-1 font-bold text-white text-center max-w-[726px] w-full mx-auto">
                    Những giá trị này không chỉ là tiêu chí hoạt động mà còn là <br /> phương châm sống của mỗi thành
                    viên trong đội ngũ của chúng tôi.
                </div>
               </div>
                <div class="max-w-[574px] w-full mx-auto">
                    <JPicture :src="isHome ? '/assets/images/home/image-what-we-do.png' : '/assets/images/about/image-core-value.png'" alt="image what we do"
                        class="picture-cover mix-blend-plus-lighter" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['values', 'isHome'],
}
</script>
