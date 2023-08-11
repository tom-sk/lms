<script setup>
import { computed } from "vue";

const props = defineProps({
    progress: {
        type: Number,
        required: true,
        default: 0,
    },
});

const style = computed(() => {
    return {
        width: `${props.progress}%`,
    };
});
</script>

<template>
    <div>
        <div class="h-2.5 w-full rounded-full bg-gray-300">
            <div class="h-2.5 rounded-full bg-blue-600" :style="style" />
        </div>
        <div class="flex w-full justify-between text-xs font-bold">
            <span>Progress</span>

            <span>{{ progress }}%</span>
        </div>
    </div>
</template>
