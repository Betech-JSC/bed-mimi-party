<template>
    <main class="bg-black">
        <!-- Room Detail -->
        <SectionRoomSlider :items="roomDetail.images" />
        <section class="pt-20 pb-[120px] relative overflow-hidden">
             <div class="circle-orange right-[-307px] top-[-400px]"></div>
            <div class="circle-orange left-[-279px] top-[250px]"></div>
           <div class="relative">
             <div class="container">
                <div class="max-w-[800px] w-full mx-auto text-center flex flex-col items-center justify-center">
                    <h2 class="text-white text-center">
                        <span class="display-1">Your room </span>
                        <span class="display-2">include</span>
                    </h2>
                    <div class="body-2 text-white mt-8 mb-12">
                        Phòng có diện tích khoảng 35–40m², thiết kế hiện đại với ánh sáng đỏ ấm, trần gương và hệ thống
                        âm thanh sống động chuẩn bar pub. Không gian lý tưởng cho nhóm 8–12 người, mang đến sự riêng tư
                        nhưng vẫn giữ trọn không khí sôi động. Màn hình LED lớn, khu vực sân khấu nhỏ và bàn ghế sang
                        trọng tạo điều kiện cho các hoạt động giải trí và giao lưu. Phù hợp cho tiệc sinh nhật, hội nhóm
                        bạn bè, gặp gỡ đối tác trong không gian năng động, trẻ trung. Đây là lựa chọn hoàn hảo để vừa
                        chill, vừa tận hưởng âm nhạc và thức uống trong không khí cuốn hút.
                    </div>
                    <Link :href="route('contact')">
                        <Button> Book now </Button>
                    </Link>
                </div>
            </div>
           </div>
        </section>
            <section class="xl:pt-[120px] xl:pb-[200px] relative py-12 md:py-16">
                <div class="circle-orange-2 left-[-279px] top-[567px]"></div>
                <div class="relative">
                    <div class="container md:space-y-6 space-y-8 xl:space-y-8">
                        <h2 class="text-white text-center">
                            <span class="display-2">More</span> <span class="display-1"> Rooms</span> 
                        </h2>
                        <div class="grid md:grid-cols-3 gap-4 xl:gap-6">
                            <div v-for="(itemRoom, indexRoom) in rooms.slice(0, 3)" :key="indexRoom" class="relative lg:hover:shadow-[0px_2px_20px_rgba(217,45,32,0.66)] duration-300 ease-in-out">
                                <div class="aspect-w-7 aspect-h-5">
                                    <JPicture
                                        :src="itemRoom.image"
                                        :alt="itemRoom.title"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <div class="absolute bottom-0 left-0 pb-4 px-5 w-full">
                                    <div class="headline-2 text-white">{{ itemRoom.title }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center">
                            <Link :href="route('home')">
                                <Button> All rooms </Button>
                            </Link>
                        </div>
                    </div>
                </div>
            </section>

        <!-- Room Master -->
        <BannerImage :banner="banner" classBanner="h-[380px]" />
        <section class="md:py-16 py-12 xl:py-20 relative overflow-hidden">
            <div class="circle-orange right-[-257px] top-[-190px]"></div>
            <div class="circle-orange-2 left-[-279px] top-[403px]"></div>
            <div class="relative">
                <div class="container">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-6 xl:gap-x-6 xl:gap-y-8">
                        <div
                            v-for="(itemRoom, indexRoom) in rooms"
                            :key="indexRoom"
                            class="relative lg:hover:shadow-[0px_2px_20px_rgba(217,45,32,0.66)] duration-300 ease-in-out"
                        >
                            <div class="aspect-w-7 aspect-h-5">
                                <JPicture
                                    :src="itemRoom.image"
                                    :alt="itemRoom.title"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                            <div class="absolute bottom-0 left-0 pb-4 px-5 w-full">
                                <div class="headline-2 text-white">{{ itemRoom.title }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
export default {
    props: ['services', 'banner'],
    data() {
        return {
            banner: {
                titleFirst: this.tt('The Rooms '),
                titleSecond: this.tt('Experiences'),
                image: '/assets/images/room/bg-banner.jpg',
            },
            rooms: [
                {
                    image: '/assets/images/home/image-room-1.jpg',
                    title: 'Luxury room',
                },
                {
                    image: '/assets/images/home/image-room-2.jpg',
                    title: 'Luxury room',
                },
                {
                    image: '/assets/images/home/image-room-3.jpg',
                    title: 'Luxury room',
                },
                {
                    image: '/assets/images/home/image-room-1.jpg',
                    title: 'Luxury room',
                },
                {
                    image: '/assets/images/home/image-room-2.jpg',
                    title: 'Luxury room',
                },
                {
                    image: '/assets/images/home/image-room-3.jpg',
                    title: 'Luxury room',
                },
            ],
            roomDetail: {
                title: 'Luxury',
                images: [
                    {
                        image: {
                            url: '/assets/images/home/image-room-1.jpg',
                            alt: 'image',
                        },
                        image_mobile: {
                            url: '/assets/images/home/image-room-1.jpg',
                            alt: 'image',
                        },
                        title: 'Image',
                    },
                    {
                        image: {
                            url: '/assets/images/home/image-room-2.jpg',
                            alt: 'image',
                        },
                        image_mobile: {
                            url: '/assets/images/home/image-room-2.jpg',
                            alt: 'image',
                        },
                        title: 'Image',
                    },
                    {
                        image: {
                            url: '/assets/images/home/image-room-3.jpg',
                            alt: 'image',
                        },
                        image_mobile: {
                            url: '/assets/images/home/image-room-3.jpg',
                            alt: 'image',
                        },
                        title: 'Image',
                    },
                    {
                        image: {
                            url: '/assets/images/home/image-room-4.jpg',
                            alt: 'image',
                        },
                        image_mobile: {
                            url: '/assets/images/home/image-room-4.jpg',
                            alt: 'image',
                        },
                        title: 'Image',
                    },
                ],
            },
        }
    },
}
</script>
