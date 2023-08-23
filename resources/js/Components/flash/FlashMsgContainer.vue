<script setup>
import FlashSuccess from "@/Components/flash/FlashSuccess.vue";
import { TransitionRoot } from "@headlessui/vue";
import { onMounted, ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const isShowing = ref(false);

const toggle = () => {
    isShowing.value = !isShowing.value;
};

onMounted(() => {
    if (
        usePage().props.flash ||
        usePage().props.flash.success.length > 0 ||
        usePage().props.flash.errors.length > 0
    ) {
        setTimeout(() => {
            toggle();
        }, 500);
    }

    setTimeout(() => {
        isShowing.value = false;
    }, 5000);
});
</script>

<template>
    <div
        class="fixed bottom-0 left-1/2 w-1/2 -translate-x-1/2 -translate-y-1/2 transform"
    >
        <TransitionRoot
            :show="isShowing"
            enter="transition duration-200 ease-out"
            enter-from="scale-95 opacity-0"
            enter-to="scale-100 opacity-100"
            leave="transition duration-150 ease-in"
            leave-from="scale-100 opacity-100"
            leave-to="scale-95 opacity-0"
        >
            <FlashSuccess v-if="$page.props.flash.success" @close="toggle()" />
        </TransitionRoot>

        <div v-if="$page.props.flash.errors" class="alert">
            {{ $page.props.flash.errors }}
        </div>
    </div>
</template>
