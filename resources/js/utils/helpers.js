export default {
    formatCurrency(number) {
        return new Intl.NumberFormat("en-GB", {
            style: "currency",
            currency: "GBP",
        })
            .format(number)
            .replace(/(\.|,)00$/g, "");
    },
};
