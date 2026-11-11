<template>
    <section class="py-12 xl:py-[60px]">
        <div class="container space-y-6">
            <h2 class="title-linear display-2 uppercase font-extrabold md:text-right">Khách hàng tiêu biểu</h2>
            <div class="h-[300px] overflow-y-auto partner-scroll">
                <div class="grid grid-cols-3 md:grid-cols-4 xl:grid-cols-6 gap-y-3 gap-x-3 md:gap-x-6 xl:gap-x-8">
                    <div
                        v-for="(itemPartner, indexPartner) in displayPartners"
                        :key="indexPartner"
                        class="flex items-center justify-center min-h-[100px] grayscale lg:hover:grayscale-0 duration-300 ease-in-out"
                    >
                        <a
                            v-if="itemPartner?.link"
                            :href="itemPartner.link"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-auto h-10 block"
                        >
                            <JPicture
                                :src="getPartnerImage(itemPartner)"
                                :alt="itemPartner?.image?.alt || itemPartner?.title || 'image partner'"
                                class="w-full h-full object-contain"
                            />
                        </a>
                        <div v-else class="w-auto h-10">
                            <JPicture
                                :src="getPartnerImage(itemPartner)"
                                :alt="itemPartner?.image?.alt || itemPartner?.title || 'image partner'"
                                class="w-full h-full object-contain"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['partners'],
    data() {
        return {
            defaultPartners: [
                '/assets/images/demo/image-partner-1.png',
                '/assets/images/demo/image-partner-2.png',
                '/assets/images/demo/image-partner-3.png',
                '/assets/images/demo/image-partner-4.png',
                '/assets/images/demo/image-partner-5.png',
                '/assets/images/demo/image-partner-6.png',
                '/assets/images/demo/image-partner-7.png',
                '/assets/images/demo/image-partner-8.png',
                '/assets/images/demo/image-partner-9.png',
                '/assets/images/demo/image-partner-10.png',
                '/assets/images/demo/image-partner-11.png',
                '/assets/images/demo/image-partner-12.png',
            ],
        }
    },
    computed: {
        displayPartners() {
            if (this.partners && this.partners.length > 0) {
                return this.partners
            }
            return this.defaultPartners
        },
    },
    methods: {
        getPartnerImage(partner) {
            if (!partner) return ''
            if (typeof partner === 'string') return partner
            return partner.image?.url || partner.image || ''
        },
    },
}
</script>

<style lang="scss" scoped>
/* width */
.partner-scroll::-webkit-scrollbar {
    @apply w-2;
}

/* Track */
.partner-scroll::-webkit-scrollbar-track {
    @apply bg-transparent;
}

/* Handle */
.partner-scroll::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #98cdff 0%, #558dfc 100%);
    border-radius: 10px;
}
</style>
