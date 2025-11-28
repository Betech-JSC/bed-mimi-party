<template>
    <Link
        :href="
            route('promotions.show', {
                slug: item.slug ?? '',
            })
        "
        v-if="item && item.slug"
        class="relative"
        @mouseenter="isHovered = true"
        @mouseleave="isHovered = false"
    >
        <div class="bg-white w-full space-y-2.5 pt-2.5 pb-5 px-3 xl:px-[14px]">
            <div class="headline-3 text-black text-center">{{ formatDate(item.published_at) }}</div>
            <div class="md:aspect-w-3 md:aspect-h-4 aspect-w-4 aspect-h-5 relative">
                <!-- Image displayed by default -->
                <JPicture
                    :src="item.image.url"
                    :alt="item.title"
                    class="w-full h-full object-cover transition-opacity duration-300"
                />
                <!-- YouTube video displayed on hover -->
                <!-- <iframe
                    v-if="item.link && isHovered"
                    :src="getYouTubeEmbedUrl(item.link)"
                    :title="item.title"
                    class="w-full h-full object-cover transition-opacity duration-300"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe> -->
                <!-- Fallback content if no video link or image -->
                <div
                    v-if="!item.image?.url && !item.link"
                    class="w-full h-full bg-gray-200 flex items-center justify-center"
                >
                    <span>No video or image available</span>
                </div>
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
    data() {
        return {
            //isHovered: false, // Reactive state to track hover
        };
    },
    methods: {
        formatDate(dateString) {
            // Convert '2025-09-05' to '05.09.2025'
            if (!dateString) return '';
            const [year, month, day] = dateString.split('-');
            return `${day.padStart(2, '0')}.${month.padStart(2, '0')}.${year}`;
        },
        getDayOfWeek(dateString) {
            // Get day of week in English from date string
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { weekday: 'long' });
        },
        formatTime(timeString) {
            // Convert '20:00:00' to '20:00'
            if (!timeString) return '';
            return timeString.slice(0, 5); // Takes the first 5 characters (HH:mm)
        },
        //getYouTubeEmbedUrl(link) {
        //    // Extract video ID from YouTube URL and return embed URL
        //    if (!link) return '';
        //    const videoIdMatch = link.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
        //    const videoId = videoIdMatch ? videoIdMatch[1] : '';
        //    return videoId ? `https://www.youtube.com/embed/${videoId}?autoplay=1` : ''; // Added autoplay for better UX
        //},
    },
};
</script>