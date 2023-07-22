<script setup>
import {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
} from "@headlessui/vue";
import { CheckCircleIcon } from "@heroicons/vue/20/solid";
import { computed } from "vue";

const props = defineProps({
    products: {
        type: Array,
        required: true,
    },
    modelValue: {
        type: String,
        required: true,
    },
});

const emit = defineEmits(["update:modelValue"]);

const value = computed({
    get() {
        return props.modelValue;
    },
    set(value) {
        emit("update:modelValue", value);
    },
});
</script>

<template>
    <div class="mt-10 border-t border-gray-200 pt-10">
        <RadioGroup v-model="value">
            <RadioGroupLabel class="text-lg font-medium text-gray-900"
                >Delivery method</RadioGroupLabel
            >

            <div
                class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4"
            >
                <RadioGroupOption
                    v-for="product in products"
                    :key="product.stripe_id"
                    v-slot="{ checked, active }"
                    as="template"
                    :value="product.stripe_id"
                >
                    <div
                        :class="[
                            checked ? 'border-transparent' : 'border-gray-300',
                            active ? 'ring-2 ring-indigo-500' : '',
                            'relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none',
                        ]"
                    >
                        <span class="flex flex-1">
                            <span class="flex flex-col">
                                <RadioGroupLabel
                                    as="span"
                                    class="block text-sm font-medium text-gray-900"
                                    >{{ product.title }}</RadioGroupLabel
                                >

                                <RadioGroupDescription
                                    as="span"
                                    class="mt-6 text-sm font-medium text-gray-900"
                                    >{{ product.price }}</RadioGroupDescription
                                >
                            </span>
                        </span>
                        <CheckCircleIcon
                            v-if="checked"
                            class="h-5 w-5 text-indigo-600"
                            aria-hidden="true"
                        />
                        <span
                            :class="[
                                active ? 'border' : 'border-2',
                                checked
                                    ? 'border-indigo-500'
                                    : 'border-transparent',
                                'pointer-events-none absolute -inset-px rounded-lg',
                            ]"
                            aria-hidden="true"
                        />
                    </div>
                </RadioGroupOption>
            </div>
        </RadioGroup>
    </div>
</template>
