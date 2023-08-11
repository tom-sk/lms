<script setup>
import { useSlidesStore } from "@/stores/slides.js";
import { storeToRefs } from "pinia";
const slidesStore = useSlidesStore();
const { moduleProgress } = storeToRefs(slidesStore);
</script>

<template>
    <div class="border-b border-black p-4">
        Module Progress
        {{ moduleProgress }}%
    </div>
</template>
