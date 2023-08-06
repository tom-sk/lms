<script setup>
import { vueVimeoPlayer } from "vue-vimeo-player";
defineProps({
    videoUrl: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div>
        <vue-vimeo-player :video-url="videoUrl" />
    </div>
</template>

<style>
iframe {
    width: 100% !important;
}
</style>
