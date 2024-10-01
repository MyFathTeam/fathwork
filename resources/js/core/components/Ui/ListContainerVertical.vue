<template>
    <dl class="sm:divide-y sm:divide-gray-200 dark:sm:divide-gray-700">
        <slot></slot>
    </dl>
</template>

<script>
export default {
    name: 'ListContainerVertical'
}
</script>

<script setup>
import { useSlots } from "vue"

const slots = useSlots()

const props = defineProps({})
</script>
