<template>
    <div>
        <div class="flex justify-between">
            <BaseLabel :for="state.uniqueId" v-if="label">
                {{ label }} <span v-if="labelHint" class="ml-2" v-tooltip="labelHint"><i class="fas fa-question-circle"></i></span>
            </BaseLabel>
            <slot name="additional-label"></slot>
        </div>
        <div
            class="mt-1"
            :class="{
                'relative': leadingIcon || trailingIcon || trailingText || currencyItem.trailingText || percentage,
                'flex': leadingText || currencyItem.leadingText,
                'rounded-md shadow-sm': rounded
            }"
        >
            <span v-if="leadingText || currencyItem.leadingText"
            class="inline-flex items-center px-3 border-gray-300 text-gray-500 sm:text-sm"
            :class="{
                'pl-10': leadingIcon,
                'border-b-2': ! invisible,
                'rounded-l-md': rounded,
                'border-r': ! invisible && leadingText,
                'border-primary dark:border-gray-700': state.focused,
                'border-gray-300 dark:border-gray-700': ! state.focused
            }"
            >
                {{leadingText || currencyItem.leadingText}}
            </span>
            <div v-if="leadingIcon" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="text-gray-400"
                    :class="leadingIcon"
                    aria-hidden="true">
                </i>
            </div>
            <input
                :id="state.uniqueId"
                v-bind="$attrs"
                :placeholder="placeholder || label"
                class="focus:ring-0 focus:border-primary dark:focus:border-gray-200 bg-inherit block w-full border-0 border-gray-300 dark:border-gray-700 dark:text-gray-200 disabled:bg-gray-200 dark:disabled:bg-gray-700"
                :class="{
                    'text-sm': textSize == 'sm',
                    'text-lg': textSize == 'lg',
                    'text-xl': textSize == 'xl',
                    'text-2xl': textSize == '2xl',
                    'text-right': align == 'right',
                    'text-center': align == 'center',
                    'border-b-2': ! invisible,
                    'pr-12': align == 'right' && trailingText,
                    'pl-10': leadingIcon,
                    'pr-10': trailingIcon || currencyItem.trailingText || percentage,
                    'rounded-md': rounded && ! leadingText && ! currencyItem.leadingText && ! adjacentLeft && ! adjacentRight && ! adjacentCenter,
                    'rounded-r-md': rounded && (leadingText || currencyItem.leadingText || adjacentRight),
                    'rounded-l-md': rounded && adjacentLeft,
                }"
                @focus="state.focused = true"
                @blur="state.focused = false"
                :type="(currency || percentage) ? 'number' : $attrs.type"
                :step="currency ? currencyItem.step : (percentage ? .01 : $attrs.step)"
                :value="modelValue"
                @input="updateInput"
            />
            <div v-if="trailingIcon || trailingText || currencyItem.trailingText || percentage" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                <i v-if="trailingIcon"
                    class="text-gray-400"
                    :class="trailingIcon"
                    aria-hidden="true">
                </i>
                <span v-if="currencyItem.trailingText" class="border-gray-300 text-gray-500 sm:text-sm">
                    {{currencyItem.trailingText}}
                </span>
                <span v-if="trailingText" class="border-gray-300 text-gray-500 sm:text-sm">
                    {{trailingText}}
                </span>
                <span v-if="percentage" class="border-gray-300 text-gray-500 sm:text-sm">
                    %
                </span>
            </div>
        </div>
        <FormError :error="error" />
    </div>
</template>

<script>
export default {
    name: 'BaseInput',
    inheritAttrs: false,
    methods: {
        updateInput($event) {
            this.$emit('update:modelValue', $event.target.value)
            this.$emit('update:error', '')
        }
    }
}
</script>

<script setup>
import { onMounted, reactive, computed, watch } from 'vue'
import { useStore } from "vuex"

const store = useStore()

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    currency: {
        type: Boolean,
        default: false
    },
    currencyName: {
        type: String,
        default: 'USD'
    },
    labelHint: {
        type: String,
        default: '',
    },
    placeholder: {
        type: String,
        default: ''
    },
    modelValue: {
        type: [String, Number],
        default: ''
    },
    error: {
        type: String,
        default: ''
    },
    rounded: {
        type: Boolean,
        default: false
    },
    leadingIcon: {
        type: String,
        default: ''
    },
    trailingIcon: {
        type: String,
        default: ''
    },
    leadingText: {
        type: String,
        default: ''
    },
    trailingText: {
        type: String,
        default: ''
    },
    percentage: {
        type: Boolean,
        default: false
    },
    adjacentLeft: {
        type: Boolean,
        default: false
    },
    adjacentCenter: {
        type: Boolean,
        default: false
    },
    adjacentRight: {
        type: Boolean,
        default: false
    },
    invisible: {
        type: Boolean,
        default: false
    },
    align: {
        type: String,
        default: 'left'
    },
    textSize: {
        type: String,
        default: 'sm'
    },
})

const defaultCurrencyDetail = computed(() => store.getters['config/config']('system.currency'))
const currencyDetail = computed(() => {
    let currencyFound;
    if (props.currencyName) {
        currencyFound = store.getters['config/config']('system.currencies').find(currency => currency.name == props.currencyName)
    }

    return currencyFound === undefined ? defaultCurrencyDetail : currencyFound
})

const state = reactive({
    uniqueId: '',
    focused: false
})

const currencyItem = reactive({
    leadingText: '',
    trailingText: '',
    step: 2
})

const updateCurrency = () => {
    if (props.currency) {
        if (currencyDetail.value.position == 'prefix') {
            currencyItem.leadingText = currencyDetail.value.symbol
        } else {
            currencyItem.trailingText = currencyDetail.value.symbol
        }
        currencyItem.step = 1 / Math.pow(10, currencyDetail.value.decimal)
    }
}

watch(() => props.currencyName, () => {
    updateCurrency()
})

onMounted(() => {
    state.uniqueId = props.id || Math.random()
        .toString(16)
        .slice(2)

    updateCurrency()
})
</script>
