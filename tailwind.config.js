import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.antlers.html",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                yellow: {
                    default: "#FCC00E",
                },
                orange: {
                    default: "#EF6F4A",
                },
                coral: {
                    default: "#FFAB91",
                },
                purple: {
                    default: "#794c79",
                    100: "#7E57C2",
                    200: "#AB47BC",
                    300: "#692169",
                },
                black: {
                    default: "#333",
                },
                red: {
                    300: "#e52629",
                },
                blue: {
                    200: "#43D3E8FF",
                    300: "#06AED5",
                    400: "#5C97C7",
                    500: "#376d94",
                },
                gray: {
                    100: "#fdfdfd",
                    200: "#f8f8f8",
                    300: "#b6b6b6",
                    400: "#cecece",
                    500: "#999999",
                    600: "#707070",
                },
                green: {
                    default: "#9CCC65",
                    100: "#73BEB7",
                    200: "#43A69B",
                    500: "#0B5145",
                },
            },
        },
    },

    plugins: [forms],
};
