<script setup>
import GuestNav from "@/Components/nav/GuestNav.vue";
import AppNav from "@/Components/nav/AppNav.vue";
</script>
<template>
    <AppNav v-if="$page.props.auth.user !== null" />
    <GuestNav v-else />
    <div
        class="flex min-h-screen flex-col items-center bg-gray-200 pt-6 sm:justify-center sm:pt-0"
    >
        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-lg sm:max-w-2xl sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
