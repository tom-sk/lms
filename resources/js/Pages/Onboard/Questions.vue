<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { onBeforeMount } from "vue";
import { RadioGroup } from "@headlessui/vue";
import RadioButtons from "@/Components/form/RadioButtons.vue";
import CheckBoxes from "@/Components/form/CheckBoxes.vue";

defineOptions({ layout: GuestLayout });

const props = defineProps({
    questions: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({ formData: {} });

onBeforeMount(() => {
    props.questions.map((question) => {
        const questionTitle = question["title"];

        form.formData[questionTitle] = {
            user_answer: [],
        };
    });
});
</script>

<template>
    <Head title="Register" />
    {{ questions }}
    <br />
    <br />
    <br />
    {{ form.formData }}

    <div class="gap-4">
        <RadioButtons />

        <div>
            <div v-for="question in questions" :key="question.id">
                {{ question.title }}

                <div v-if="question.type === 'text'">
                    <input
                        v-model="
                            form.formData[question['title']]['user_answer']
                        "
                        type="text"
                    />
                </div>

                <div v-if="question.type === 'mutliselect'" :key="question.id">
                    <CheckBoxes
                        v-model="
                            form.formData[question['title']]['user_answer']
                        "
                        :options="question.options"
                    />
                </div>
            </div>
        </div>

        <Link :href="route('dashboard')">
            <PrimaryButton class="mt-4">Dashboard</PrimaryButton>
        </Link>
    </div>
</template>
