<template>
    <dt class="font-medium" :class="{
        'text-sm': fontSize == 'sm',
        'text-xs': fontSize == 'xs',
        'text-gray-500 dark:text-gray-400': ! revert,
        'text-gray-900 dark:text-gray-300': revert
    }">
        <slot>{{label}}</slot>
    </dt>
</template>

<script>
export default {
    name: 'BaseDataList'
}
</script>

<script setup>
const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    revert: {
        type: Boolean,
        default: false
    },
    fontSize: {
        type: String,
        validator(value) {
            return ["xs", "sm"].includes(value)
        },
        default: 'sm'
    }
})
</script>
