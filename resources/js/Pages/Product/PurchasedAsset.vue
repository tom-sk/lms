<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    products: {
        type: Array,
    },
});
</script>

<template>
    <div>
        <h2 class="text-lg font-medium text-gray-900">Purchased Asset</h2>
        <div class="space-y-4 divide-y divide-gray-300">
            <div
                v-for="item in products"
                :key="item.id"
                class="flex items-center justify-between pt-4"
            >
                <span>{{ item.title }}</span>

                <a :href="item.asset" target="_blank" download>
                    <PrimaryButton>Download</PrimaryButton>
                </a>
            </div>
        </div>
    </div>
</template>
