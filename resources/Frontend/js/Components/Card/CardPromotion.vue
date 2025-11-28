<template>
    <Link
        :href="
            route('promotions.show', {
                slug: item.slug ?? '',
            })
        "
        v-if="item && item.slug"
        class="relative"
    >
        <div class="bg-white w-full space-y-2.5 pt-2.5 pb-5 px-3 xl:px-[14px]">
            <div class="headline-3 text-black text-center">{{ formatDate(item.published_at) }}</div>
            <div class="md:aspect-w-3 md:aspect-h-4 aspect-w-4 aspect-h-5">
                <JPicture :src="item.image.url" :alt="item.title" class="w-full h-full object-cover" />
            </div>
            <div class="flex items-center justify-between text-black uppercase">
                <div class="title-4">{{ formatTime(item.time) }}</div>
                <div class="title-4">{{ getDayOfWeek(item.published_at) }}</div>
            </div>
        </div>
        <div class="py-2 px-5">
            <div class="title-2 text-white uppercase">{{ item.title }}</div>
        </div>
    </Link>
</template>
<script>
export default {
    props: ['item'],
    methods: {
        formatDate(dateString) {
            // Convert '2025-09-05' to '05.09.2025'
            if (!dateString) return ''
            const [year, month, day] = dateString.split('-')
            return `${day.padStart(2, '0')}.${month.padStart(2, '0')}.${year}`
        },
        getDayOfWeek(dateString) {
            // Get day of week in English from date string
            if (!dateString) return ''
            const date = new Date(dateString)
            return date.toLocaleDateString('en-US', { weekday: 'long' })
        },
        formatTime(timeString) {
            // Convert '20:00:00' to '20:00'
            if (!timeString) return ''
            return timeString.slice(0, 5) // Takes the first 5 characters (HH:mm)
        },        
    },
}
</script>
