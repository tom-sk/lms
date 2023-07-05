<script setup>
defineProps({
    table: {
        type: Array,
        required: true,
    },
});

const formatCell = (cell) => {
    if (cell.type === "paragraph" && cell.content && cell.content.length >= 1) {
        return cell.content[0].text;
    } else {
        return "<br/>";
    }
};
</script>

<template>
    <table class="min-w-full border-collapse border border-slate-500">
        <tbody>
            <tr v-for="(row, index) in table" :key="index">
                <td
                    v-for="(item, index) in row.content"
                    :key="index"
                    class="border border-slate-700 p-2"
                    :colspan="item.attrs ? item.attrs.colspan : ''"
                    :rowspan="item.attrs ? item.attrs.rowspan : ''"
                >
                    <template
                        v-for="(cell, index) in item.content"
                        :key="index"
                    >
                        <p v-html="formatCell(cell)" />
                    </template>
                </td>
            </tr>
        </tbody>
    </table>
</template>
