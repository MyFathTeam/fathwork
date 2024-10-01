<template>
    <th
        scope="col"
        class="sm:px-2 xl:px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
        :class="{
            'border border-gray-200 dark:border-gray-600': bordered,
            'text-right': align == 'right',
            'text-center': align == 'center',
        }"
    >
        <slot></slot>
    </th>
</template>

<script>
export default {
    name: 'DataHead'
}
</script>

<script setup>
const props = defineProps({
    align: {
        type: String,
        default: 'left'
    },
    bordered: {
        type: Boolean,
        default: false
    }
})
</script>
