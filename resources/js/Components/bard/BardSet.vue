<script setup>
defineProps({
    set: {
        type: Array,
        required: true,
        default: () => [],
    },
});
</script>

<template>
    <div>
        <img
            v-if="set.values.type === 'image'"
            :src="'/storage/' + set.values.image[0]"
            alt=""
        />
    </div>
</template>
