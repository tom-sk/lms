<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { onBeforeMount, ref } from "vue";
import InputError from "@/Components/InputError.vue";
import CheckBoxGroup from "@/Components/form/CheckBoxGroup.vue";

defineOptions({ layout: GuestLayout });

const props = defineProps({
    questions: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({ formData: [] });

const submit = () => {
    form.post(route("onboard.questions"));
};

onBeforeMount(() => {
    props.questions.map((question) => {
        let answerType = {};

        console.log(question["answer"]);

        if (question["type"] === "text") {
            answerType = {
                text_answer: question["answer"]
                    ? question["answer"][0]["value"]
                    : "",
            };
        } else if (question["type"] === "mutliselect") {
            answerType = {
                options_answer: question["answer"]
                    ? question["answer"][0]["value"]
                    : ["No"],
            };
        }

        form.formData.push({
            ...answerType,
            type: question["type"],
            id: question["id"],
        });
    });
});
</script>

<template>
    <Head title="Register" />

    <!--    {{ questions }}-->

    <div class="gap-4">
        <div>
            <div
                v-for="(question, index) in questions"
                :key="question.id"
                class="mb-4"
            >
                {{ question.title }}

                <div v-if="question.type === 'text'">
                    <input
                        v-model="form.formData[index]['text_answer']"
                        type="text"
                    />

                    <InputError
                        :message="form.errors[`formData.${index}.text_answer`]"
                    />
                </div>

                <div v-if="question.type === 'mutliselect'" :key="question.id">
                    <CheckBoxGroup
                        v-model="form.formData[index]['options_answer']"
                        :options="question.options"
                    />

                    <InputError
                        :message="
                            form.errors[`formData.${index}.options_answer`]
                        "
                    />
                </div>
            </div>
        </div>

        <InputError class="mt-2" :message="form.errors.formData" />

        <PrimaryButton @click="submit">Submit</PrimaryButton>

        <Link :href="route('dashboard')">
            <PrimaryButton class="mt-4">Dashboard</PrimaryButton>
        </Link>
    </div>
</template>
