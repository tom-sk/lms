<script setup>
import FlashMsgContainer from "@/Components/flash/FlashMsgContainer.vue";
import AppNav from "@/Components/nav/AppNav.vue";
import TopicBreadCrumbs from "@/Components/topics/TopicBreadCrumbs.vue";
</script>

<template>
    <div>
        <div class="flex min-h-screen flex-col bg-gray-200">
            <AppNav />

            <TopicBreadCrumbs />

            <!-- Page Content -->
            <main class="flex h-full grow">
                <slot />
            </main>
        </div>
    </div>

    <FlashMsgContainer />
</template>
