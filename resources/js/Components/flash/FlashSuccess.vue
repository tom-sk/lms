<script setup>
import { XMarkIcon } from "@heroicons/vue/24/outline";

defineEmits(["close"]);
</script>

<template>
    <div class="alert relative rounded bg-green-600 p-8 text-white shadow">
        {{ $page.props.flash.success }}

        <XMarkIcon
            class="absolute right-2 top-2 w-6 cursor-pointer text-white hover:opacity-75"
            @click="$emit('close')"
        />
    </div>
</template>
