import { defineStore } from "pinia";
import { ref } from "vue";

export const useConfigStore = defineStore("config", () => {
    const stripeKey = ref(
        "pk_test_51K59QtBmxT5gIh6pYdyliYMQKQtlvl354uJr2jTuXF7wi0r797i8N5M0hPR10OhMQjqY8qCeSEYOLTQPXUtFlI3K00rIhR1XFP"
    );

    return {
        stripeKey,
    };
});
