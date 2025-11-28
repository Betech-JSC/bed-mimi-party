<template>
    <div class="relative">
        <div class="bg-white w-full h-full space-y-2.5 p-4">
            <div class="md:aspect-w-3 md:aspect-h-4 aspect-w-4 aspect-h-5">
                <JPicture :src="item.image.url" :alt="item.title" class="w-full h-full object-cover" />
            </div>
            <div class="flex items-center justify-between text-black uppercase">
                <div class="flex items-center gap-4 title-4">
                    <div v-if="item.time">{{ formatTime(item.time) }}</div>
                    <div>{{ getDayOfWeek(item.published_at) }}</div>
                </div>
                <div class="title-4">{{ formatDate(item.published_at) }}</div>
            </div>
        </div>
    </div>
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