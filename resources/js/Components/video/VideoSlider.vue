<script setup>
import VimeoPlayer from "@/Components/video/VimeoPlayer.vue";

defineProps({
    videos: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div class="flex max-w-6xl flex-col justify-center">
        <!--        <div class="flex bg-red-200 p-4">-->
        <!--            <div-->
        <!--                v-for="video in videos"-->
        <!--                :key="video.id"-->
        <!--                class="bg-green-300 p-2"-->
        <!--            >-->
        <!--                <VimeoPlayer :video-url="video.url" />-->
        <!--            </div>-->
        <!--        </div>-->

        <!--        <div class="mx-auto grid grid-cols-12">-->
        <!--            <div-->
        <!--                v-for="video in videos"-->
        <!--                :key="video.id"-->
        <!--                class="bg-green-300 p-2"-->
        <!--            >-->
        <!--                <img :src="'/storage/' + video.thumbnail" alt="" />-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
</template>
