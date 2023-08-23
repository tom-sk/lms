<script setup>
import FlashMsgContainer from "@/Components/flash/FlashMsgContainer.vue";
import AppNav from "@/Components/nav/AppNav.vue";
import ProfileNav from "@/Pages/Profile/Partials/ProfileNav.vue";
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-200">
            <AppNav />

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="mx-auto max-w-7xl space-y-6 py-12 sm:px-6 lg:px-8">
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <div
                            class="sticky top-0 bg-white p-4 shadow sm:rounded-lg sm:p-8"
                        >
                            <ProfileNav />
                        </div>
                    </div>

                    <div class="col-span-3">
                        <slot />
                    </div>
                </div>
            </main>
        </div>
    </div>

    <FlashMsgContainer />
</template>
