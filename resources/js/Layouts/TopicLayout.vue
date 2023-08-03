<script setup>
import FlashMsgContainer from "@/Components/flash/FlashMsgContainer.vue";
import AppNav from "@/Components/nav/AppNav.vue";
</script>

<template>
    <div>
        <div class="flex min-h-screen flex-col bg-gray-200">
            <AppNav />

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex grow">
                <slot />
            </main>
        </div>
    </div>

    <FlashMsgContainer />
</template>
