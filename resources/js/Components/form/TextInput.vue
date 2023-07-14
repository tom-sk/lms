<script setup>
import InputError from "@/Components/InputError.vue";

defineProps({
    label: {
        type: String,
        default: null,
    },
    placeholder: {
        default: null,
        type: String,
    },
    modelValue: {
        default: null,
        type: [String, Number],
    },
    type: {
        default: "text",
        type: String,
    },
    error: {
        default: null,
        type: String,
    },
});

defineEmits(["update:modelValue"]);
</script>

<template>
    <label class="text-black block flex flex-col text-sm font-medium leading-3">
        <span class="mb-1 text-xs">{{ label }}</span>
        <div
            class="text-black block flex w-full overflow-hidden rounded-sm border-none bg-gray-200 shadow-sm outline-none"
        >
            <input
                :type="type"
                class="text-black block h-12 w-full rounded-sm border bg-gray-200 px-4 py-2 font-light text-inherit focus:ring-0"
                :placeholder="placeholder"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
            />
        </div>
    </label>

    <InputError :message="error" />
</template>
