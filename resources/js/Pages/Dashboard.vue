<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import ModuleList from "@/Components/modules/ModuleList.vue";

defineProps({
    modules: {
        type: Array,
        required: true,
    },
    content: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-12" v-html="content" />

                        <h4 class="mb-8 text-xl font-bold">Modules</h4>
                        <ModuleList :modules="modules" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
