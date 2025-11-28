<template>
  <div
    v-observe-visibility="{
      callback: visibilityChanged,
      threshold: 1.0,
      throttle: 100,
      once: true
    }"
    class="text-slide-container"
    :class="{ 'is-visible': isVisible }"
  >
    <h2 class="text-white" :class="className">
      <span class="display-1 max-md:text-[30px]">
        <span
          v-for="(char, index) in textFirst"
          :key="'t1-' + index"
          :class="{ char: char !== ' ', 'animate-char': isVisible && char !== ' ', 'space': char === ' ' }"
          :style="char !== ' ' ? { animationDelay: `${calculateDelay(textFirst, index) * 0.1}s` } : {}"
        >
          {{ char }}
        </span>
      </span>
      <span class="display-2 max-md:text-[1.125em]">
        <span
          v-for="(char, index) in textSecond"
          :key="'t2-' + index"
          :class="{ char: char !== ' ', 'animate-char': isVisible && char !== ' ', 'space': char === ' ' }"
          :style="char !== ' ' ? { animationDelay: `${(calculateDelay(textFirst, textFirst.length) + calculateDelay(textSecond, index)) * 0.1}s` } : {}"
        >
          {{ char }}
        </span>
      </span>
    </h2>
  </div>
</template>

<script>
export default {
  name: 'TextSlide',
  props: {
    textFirst: {
      type: String,
      default: ''
    },
    textSecond: {
      type: String,
      default: ''
    },
    className: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      isVisible: false
    }
  },
  methods: {
    visibilityChanged(isVisible) {
      this.isVisible = isVisible
    },
    calculateDelay(text, index) {
      // Đếm số ký tự không phải khoảng trắng trước vị trí index
      return text
        .slice(0, index)
        .split('')
        .filter(char => char !== ' ').length
    }
  }
}
</script>

<style scoped>
.text-slide-container {
  overflow: hidden;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease-out;
}

.text-slide-container.is-visible {
  opacity: 1;
  visibility: visible;
}

.char {
  display: inline-block;
  opacity: 0;
  transform: translateX(-10px);
}

.char.animate-char {
  animation: slideIn 0.3s ease-out forwards;
}

.space {
  display: inline-block;
  opacity: 1; /* Khoảng trắng luôn hiển thị, không animate */
  white-space: pre; /* Giữ khoảng trắng đúng cách */
}

@keyframes slideIn {
  0% {
    opacity: 0;
    transform: translateX(-10px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}
</style>