<script setup>
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
    <div class="space-y-4">
        <NavLink
            :active="route().current('profile.edit')"
            :href="route('profile.edit')"
        >
            Profile Edit
        </NavLink>

        <NavLink
            :active="route().current('profile.products')"
            :href="route('profile.products')"
        >
            Products Purchased
        </NavLink>

        <NavLink
            :active="route().current('profile.onboard.edit')"
            :href="route('profile.onboard.edit')"
        >
            Onboarding Questions
        </NavLink>
    </div>
</template>
