<script setup>
import BardText from "@/Components/bard/BardText.vue";
import BardTable from "@/Components/bard/BardTable.vue";

defineProps({
    content: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <template v-for="(item, index) in content" :key="index">
        <BardText
            v-if="item.type === 'paragraph'"
            class="mb-4"
            :text="item.content"
        />
        <BardTable
            v-if="item.type === 'table'"
            class="mb-4"
            :table="item.content"
        />
    </template>
</template>
