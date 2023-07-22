<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-green-200">
            {{ message }}
        </p>
    </div>
</template>
