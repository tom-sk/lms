<script setup>
import { computed } from "vue";

defineProps({
    options: {
        type: Array,
        default: () => [],
    },
});

const emit = defineEmits(["update:modelValue", "change"]);

const checked = computed({
    get() {
        return props.modelValue;
    },
    set(value) {
        emit("update:modelValue", value);
    },
});
</script>

<template>
    <fieldset>
        <div class="space-y-5">
            <div v-for="item in options" class="relative flex items-start">
                <div class="flex h-6 items-center">
                    <input
                        id="comments"
                        v-model="checked"
                        aria-describedby="comments-description"
                        name="comments"
                        type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                    />
                </div>
                <div class="ml-3 text-sm leading-6">
                    <label for="comments" class="font-medium text-gray-900">
                        {{ item }}
                    </label>
                </div>
            </div>
        </div>
    </fieldset>
</template>
