<template>
    <div class="video-container">
        <video
            ref="videoPlayer"
            :poster="poster"
            :src="videoSrc"
            @click="togglePlay"
            @play="hidePlayButton"
            @pause="showPlayButton"
        >
            Trình duyệt của bạn không hỗ trợ video HTML5.
        </video>
        <button class="play-button" :class="{ hidden: isPlaying }" @click="togglePlay"></button>
    </div>
</template>

<script>
export default {
    name: 'VideoPlayer',
    props: {
        videoSrc: {
            type: String,
            required: true,
        },
        poster: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            isPlaying: false,
        }
    },
    methods: {
        togglePlay() {
            const video = this.$refs.videoPlayer
            if (video.paused) {
                video.play()
                this.isPlaying = true
            } else {
                video.pause()
                this.isPlaying = false
            }
        },
        hidePlayButton() {
            this.isPlaying = true
        },
        showPlayButton() {
            this.isPlaying = false
        },
    },
}
</script>

<style scoped>
.video-container {
    @apply relative w-full h-full;
}

video {
    @apply w-auto h-auto block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 min-w-full min-h-full;
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(0, 0, 0, 0.7);
    border: none;
    border-radius: 50%;
    width: 80px;
    height: 80px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity 0.3s;
}

.play-button:hover {
    opacity: 0.8;
}

.play-button.hidden {
    display: none;
}

.play-button::before {
    content: '';
    display: block;
    width: 0;
    height: 0;
    border-left: 25px solid white;
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
}
</style>
