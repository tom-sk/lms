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
    <div class="relative pb-[56.25%]">
        <vueVimeoPlayer :video-url="videoUrl" />
    </div>
</template>

<style>
iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}
</style>
