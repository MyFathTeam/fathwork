<template>
    <div class="w-full" :class="[
            space ? 'my-2' : '',
            rounded ? 'rounded-full' : '',
            bgColor == 'transparent' ? 'bg-transparent' : 'bg-gray-200 dark:bg-dark-header',
            height
        ]">
        <div :class="[color, height, rounded ? 'rounded-full' : '']" :style="`width: ${percent}%`"></div>
        <div v-if="value && max">{{value}} / {{max}}</div>
    </div>
</template>

<script>
export default {
    name: 'ProgressBar'
}
</script>

<script setup>
const props = defineProps({
    percent: {
        type: Number,
        default: 100
    },
    value: {
        type: [Number, String],
        default: ''
    },
    max: {
        type: [Number, String],
        default: ''
    },
    color: {
        type: String,
        default: 'default'
    },
    bgColor: {
        type: String,
        default: ''
    },
    showLabel: {
        type: Boolean,
        default: false
    },
    space: {
        type: Boolean,
        default: false
    },
    rounded: {
        type: Boolean,
        default: false
    },
    height: {
        type: String,
        validator(value) {
            return [
                "h-1",
                "h-2",
                "h-3",
                "h-4",
                "h-5",
            ].includes(value);
        },
        default: "h-1",
    },
})
</script>
