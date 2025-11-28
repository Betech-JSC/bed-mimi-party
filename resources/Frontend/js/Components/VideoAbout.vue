<template>
  <div class="video-container">
    <!-- Standard video -->
    <div v-if="!isGoogleDriveLink" class="video-wrapper">
      <video 
        ref="videoElement"
        :src="videoSrc"
        :poster="poster"
        class="video-element"
        controls
        preload="metadata"
        @click.stop="toggleVideo"
        aria-label="Video player"
      >
        Your browser does not support the video tag.
      </video>
    </div>

    <!-- Google Drive iframe -->
    <div v-else class="iframe-wrapper">
      <iframe 
        :src="googleDriveEmbedSrc"
        class="video-iframe"
        frameborder="0"
        allowfullscreen
        allow="autoplay; encrypted-media"
        aria-label="Google Drive video player"
        @error="handleIframeError"
        @click="playVideo"
      ></iframe>
      
      <!-- Poster overlay -->
      <!-- <div v-if="showPoster && poster" class="poster-overlay" @click="playVideo">
        <img :src="poster" class="poster-image" alt="Video poster" @error="handlePosterError" />
        <div class="play-button-overlay"></div>
      </div> -->

      <!-- Fallback or error message -->
      <div v-if="errorMessage || (!poster && showPoster)" class="fallback-message">
        {{ errorMessage || 'No poster available. Click to try playing video.' }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'VideoAbout',
  props: {
    videoSrc: { type: String, required: true },
    poster: { type: String, default: '' },
    autoplay: { type: Boolean, default: false }
  },
  data() {
    return {
      showPoster: true,
      errorMessage: ''
    }
  },
  computed: {
    isGoogleDriveLink() {
      return this.videoSrc.includes('drive.google.com')
    },
    googleDriveEmbedSrc() {
      if (!this.isGoogleDriveLink) return ''
      const fileIdMatch = this.videoSrc.match(/\/d\/([a-zA-Z0-9-_]+)/)
      if (fileIdMatch) {
        const src = `https://drive.google.com/file/d/${fileIdMatch[1]}/preview`
        return this.autoplay ? `${src}?autoplay=1` : src
      }
      this.errorMessage = 'Invalid Google Drive URL'
      return ''
    }
  },
  methods: {
    toggleVideo() {
      const video = this.$refs.videoElement
      if (video) {
        video.paused ? video.play() : video.pause()
      }
    },
    playVideo() {
      this.showPoster = false
      this.errorMessage = '' // Reset lỗi khi thử phát lại
    },
    handlePosterError() {
      this.showPoster = false
      this.errorMessage = 'Failed to load poster image'
    },
    handleIframeError() {
      this.showPoster = true
      this.errorMessage = 'Failed to load video (check if the video is shared publicly)'
    }
  },
  mounted() {
    if (this.autoplay && !this.isGoogleDriveLink) {
      this.$nextTick(() => {
        const video = this.$refs.videoElement
        if (video) video.play().catch(() => {})
      })
    }
    if (this.isGoogleDriveLink && (!this.poster || this.autoplay)) {
      this.showPoster = false
    }
  }
}
</script>

<style scoped>
.video-container {
  @apply relative w-full h-full cursor-pointer;
  aspect-ratio: 16/9;
}

.video-wrapper, .iframe-wrapper {
  @apply relative w-full h-full;
}

.video-element, .video-iframe {
  @apply w-full h-full object-cover rounded-none;
}

.poster-overlay {
  @apply absolute inset-0 flex items-center justify-center bg-black z-10;
  transition: opacity 0.3s ease;
}

.poster-image {
  @apply w-full h-full object-cover rounded-none;
}

.play-button-overlay {
  @apply absolute w-16 h-16 bg-white bg-opacity-80 rounded-full flex items-center justify-center;
}

.play-button-overlay:hover {
  @apply scale-110;
}

.play-button-overlay::after {
  content: '▶';
  @apply text-black text-2xl font-bold ml-1;
}

.fallback-message {
  @apply absolute inset-0 flex items-center justify-center bg-black bg-opacity-80 text-white text-center z-10;
  padding: 1rem;
}

.iframe-wrapper::after {
  content: '';
  @apply absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-10 transition-opacity z-10;
  pointer-events: none;
}

.video-element:hover, .iframe-wrapper:hover::after {
  @apply opacity-90;
}

.video-element::-webkit-media-controls-panel {
  background-color: rgba(0, 0, 0, 0.8);
}

.video-element::-webkit-media-controls-play-button {
  background-color: rgba(255, 255, 255, 0.9);
}
</style>
