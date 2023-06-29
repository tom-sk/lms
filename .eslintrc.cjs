module.exports = {
    extends: [
        "eslint:recommended",
        "plugin:vue/vue3-recommended",
        "plugin:prettier/recommended",
    ],
    parser: "vue-eslint-parser",
    parserOptions: {
        ecmaVersion: 2020,
        sourceType: "module",
    },
    env: {
        es6: true,
        browser: true,
        node: true,
    },
    plugins: [],
    ignorePatterns: ["/public/vendor/", "/addons", '*.antlers.html', '*.min.js'],
    rules: {
        "prettier/prettier": "error",
        camelcase: ["error", { properties: "never" }],
        "no-empty-function": ["error"],
        "prefer-const": ["error"],
        "vue/component-tags-order": [
            "error",
            { order: ["script", "template", "style"] },
        ],
        "vue/html-self-closing": [
            "error",
            {
                html: { void: "any", normal: "always", component: "always" },
                svg: "always",
                math: "always",
            },
        ],
        "vue/component-name-in-template-casing": ["error", "PascalCase"],
        "vue/component-api-style": ["error", ["script-setup"]],
        "vue/custom-event-name-casing": ["error"],
        "vue/html-button-has-type": ["error"],
        "vue/match-component-file-name": ["error"],
        "vue/no-duplicate-attr-inheritance": ["error"],
        "vue/no-empty-component-block": ["error"],
        "vue/no-undef-components": ["error"],
        "vue/no-unused-properties": ["error"],
        "vue/no-unused-refs": ["error"],
    },
};
