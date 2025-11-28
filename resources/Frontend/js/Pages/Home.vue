<template>
    <main class="bg-black overflow-hidden">
        <SectionHero />
        <section class="relative py-16 md:py-[100px] xl:py-[170px] z-10">
            <div class="absolute inset-0">
                <JPicture
                    src="/assets/images/home/bg-about.jpg"
                    alt="background about"
                    class="w-full h-full object-cover"
                />
            </div>
            <div class="circle-orange left-[-230px] top-[-66px]"></div>
            <div class="circle-orange right-[-230px] top-[505px]"></div>
            <div class="relative">
                <div class="container">
                    <div class="max-w-[600px] w-full mx-auto text-white space-y-5">
                        <div class="flex items-center justify-center">
                            <h2 class="display-2">{{ tt('About') }}</h2>
                            <div class="max-w-[120px] md:max-w-[150px] xl:max-w-[200px]">
                                <JPicture
                                    src="/assets/images/home/image-90s.png"
                                    alt="image 90s"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                        </div>
                        <AnimateAppear class="body-2 text-center">
                            <div v-html="$page.props.global.the_homepage_90s_content"></div>
                        </AnimateAppear>
                    </div>
                </div>
            </div>
        </section>
        <SectionRooms :items="rooms_featured" />
        <SectionPromotion :textFirst="tt('Promotion ')" :textSecond="tt('& events')" :items="promotions" />
    </main>
</template>
<script>
import CardRoom from '@/Components/Card/CardRoom.vue'
import Arrow from '@/Components/Icons/Arrow.vue'
import SectionHero from '@/Components/SectionHero.vue'
import SectionPromotion from '@/Components/SectionPromotion.vue'

export default {
    components: { Arrow, SectionPromotion, SectionHero, CardRoom },
    props: ['rooms_featured', 'promotions'],
}
</script>
