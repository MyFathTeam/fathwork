import { computed } from "vue"
import store from "@stores"

function getCurrency(currencyName = 'USD') {
    let currencies = computed(() => store.getters['config/config']('system.currencies'));

    let currency = currencies.value.find(item => item.name == currencyName)

    if (currency === undefined) {
        return {decimal: 2, position: 'prefix'};
    }

    return currency
}

export function formatAmount(amount = 0, currencyName = 'USD') {
    let currency = getCurrency(currencyName)

    return roundNumber(amount, currency.decimal || 2);
}

export function formatCurrency(amount = 0, currencyName = 'USD') {
    let currency = getCurrency(currencyName)

    amount = formatAmount(amount, currencyName)

    if(currency.position === 'prefix')
        return currency.symbol+''+ amount;
    else
        return amount+' '+currency.symbol;
}

function roundNumber(number, precision) {
    precision = Math.abs(parseInt(precision)) || 0;
    var multiplier = Math.pow(10, precision);
    return (Math.round(number * multiplier) / multiplier);
}
