<template>
  <section class="relative max-h-[320px] md:max-h-[400px] lg:max-h-[810px] xl:max-h-full h-[calc(100vh-90px)]">
    <video
      autoplay
      loop
      muted
      playsinline
      class="absolute inset-0 w-full h-full object-cover z-0"
    >
      <source src="/assets/video/video-hero.mp4" type="video/mp4" />
    </video>

    <div class="absolute bottom-0 left-0 w-full h-[120px] bg-linear-hero z-10"></div>
  </section>
</template>
