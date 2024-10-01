<template>
    <div :class="{
        'mb-6': first,
        'my-6': ! first
    }">
        <h2 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-400" v-if="title">{{title}}</h2>
        <p class="mt-1 text-sm text-gray-500" v-if="description">{{description}}</p>
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'CardHeader'
}
</script>

<script setup>
const props = defineProps({
    title: {
        type: String,
        default: '',
    },
    description: {
        type: String,
        default: ''
    },
    first: {
        type: Boolean,
        default: false
    }
})
</script>
