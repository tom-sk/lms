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
    <div class="video relative">
        <vue-vimeo-player :video-url="videoUrl" />
    </div>
</template>

<style>
.video {
    height: 0;
    overflow: hidden;
    padding-bottom: 56.25%;
}

iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}
</style>
