<script setup>
import InputError from "@/Components/InputError.vue";
import CheckBoxGroup from "@/Components/form/CheckBoxGroup.vue";
import { useForm } from "@inertiajs/vue3";
import { onBeforeMount } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/form/TextInput.vue";

const props = defineProps({
    answers: {
        type: Array,
        default: () => [],
    },
    questions: {
        type: Array,
        default: () => [],
    },
    postRoute: {
        type: String,
        default: "",
        required: true,
    },
    buttonText: {
        type: String,
        default: "next",
    },
    reset: {
        type: Boolean,
        default: true,
    },
});

const form = useForm({ formData: [] });

form.defaults({ formData: [] });

const submit = () => {
    form.post(props.postRoute, {
        preserveScroll: true,
        onSuccess: () => {
            if (props.reset) {
                form.reset("formData");
            }
        },
    });
};

onBeforeMount(() => {
    form.formData = [];

    const answers = props.answers;

    props.questions.map((question) => {
        let answerType = {};
        let answerValue = "";

        answers.map((answer) => {
            if (answer["question_id"] === question["id"]) {
                answerValue = answer.value;
            }
        });

        if (question["type"] === "text") {
            answerType = {
                text_answer: answerValue,
            };
        } else if (question["type"] === "mutliselect") {
            answerType = {
                options_answer: answerValue ? answerValue : [""],
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
    <div class="gap-4">
        <div class="space-y-12">
            <div
                v-for="(question, index) in questions"
                :key="question.id"
                class="mb-4"
            >
                <div v-if="question.type === 'text'">
                    <TextInput
                        v-model="form.formData[index]['text_answer']"
                        :label="question.title"
                        :error="form.errors[`formData.${index}.text_answer`]"
                    />
                </div>

                <div v-if="question.type === 'mutliselect'" :key="question.id">
                    <CheckBoxGroup
                        v-model="form.formData[index]['options_answer']"
                        :label="question.title"
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

        <div class="flex justify-end">
            <PrimaryButton
                type="submit"
                :loading="form.processing"
                @click="submit"
            >
                {{ buttonText }}
            </PrimaryButton>
        </div>
    </div>
</template>
