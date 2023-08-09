<script setup>
import { computed } from "vue";
import FormCheckBox from "@/Components/form/FormCheckBox.vue";

const props = defineProps({
    options: {
        type: Array,
        default: () => [],
    },
    modelValue: {
        type: Array,
        default: () => [],
    },
});

const emit = defineEmits(["update:modelValue"]);

const checkedValues = computed({
    get() {
        return props.modelValue;
    },
    set(value) {
        emit("update:modelValue", value);
    },
});
</script>

<template>
    <div class="flex flex-col">
        <label v-for="(item, index) in options" :key="index">
            <FormCheckBox v-model="checkedValues" :value="item" />
            {{ item }}
        </label>
    </div>
</template>
