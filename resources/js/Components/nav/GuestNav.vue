<script setup>
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
    <nav class="flex bg-white">
        <div class="mx-auto flex w-full max-w-7xl justify-between">
            <div class="flex items-center">
                <div class="h-8 w-20">
                    <img
                        class="h-auto w-full"
                        src="http://localhost/storage/logo.png"
                        alt=""
                    />
                </div>

                <ul class="flex items-center justify-center space-x-4 p-4">
                    <li>
                        <a
                            class="transition-text ease block rounded-md bg-gray-700 px-3 py-2 text-base font-bold text-white transition-all transition-opacity hover:bg-gray-700 hover:opacity-75"
                            href="/"
                            >Home</a
                        >
                    </li>
                </ul>
            </div>

            <ul class="flex items-center justify-center space-x-4 p-4">
                <li>
                    <NavLink
                        :active="route().current('login')"
                        :href="route('login')"
                        >Login</NavLink
                    >
                </li>
                <li>
                    <NavLink
                        :href="route('register')"
                        :active="route().current('register')"
                        >Register</NavLink
                    >
                </li>
            </ul>
        </div>
    </nav>
</template>
