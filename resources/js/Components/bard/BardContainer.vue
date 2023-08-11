<script setup>
import BardText from "@/Components/bard/BardText.vue";
import BardTable from "@/Components/bard/BardTable.vue";
import BardSet from "@/Components/bard/BardSet.vue";
import { computed } from "vue";

const props = defineProps({
    content: {
        type: String,
        required: true,
    },
});

const formattedContent = computed(() => {
    return JSON.parse(props.content);
});
</script>

<template>
    <template v-for="(item, index) in formattedContent" :key="index">
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
        <BardSet v-if="item.type === 'set'" :set="item.attrs" />
    </template>
</template>
