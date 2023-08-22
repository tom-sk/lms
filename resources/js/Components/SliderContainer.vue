<script setup>
import { Carousel, Slide } from "vue3-carousel";
import { ref } from "vue";
import {
    ChevronLeftIcon,
    ChevronRightIcon,
} from "@heroicons/vue/20/solid/index.js";

const emit = defineEmits(["setItem"]);

defineProps({
    items: {
        type: Array,
        required: true,
    },
});

const settings = {
    itemsToShow: 2,
    snapAlign: "start",
};

const currentSlide = ref(0);

const next = () => {
    currentSlide.value++;
};

const prev = () => {
    if (currentSlide.value === 0) return;
    currentSlide.value--;
};

const setResource = (resource) => {
    emit("setItem", resource);
};
</script>

<template>
    <div class="flex max-w-6xl flex-col justify-center">
        <div class="">
            <div class="flex w-full items-center">
                <div v-if="items.length > 2" class="w-12">
                    <ChevronLeftIcon
                        class="w-12 cursor-pointer"
                        @click="prev"
                    />
                </div>

                <div class="w-full">
                    <Carousel v-bind="settings" v-model="currentSlide">
                        <Slide
                            v-for="item in items"
                            :key="item.id"
                            class="h-32"
                        >
                            <div
                                class="m-4 h-32 w-full"
                                @click="setResource(item)"
                            >
                                <div
                                    class="h-32 w-full cursor-pointer bg-red-100 bg-cover bg-center bg-no-repeat hover:opacity-75"
                                    :style="{
                                        backgroundImage:
                                            item.image ||
                                            'url(https://picsum.photos/200/300)',
                                    }"
                                />
                            </div>
                        </Slide>
                    </Carousel>
                </div>

                <div v-if="items.length > 2" class="w-12">
                    <ChevronRightIcon
                        class="w-12 cursor-pointer"
                        @click="next"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
