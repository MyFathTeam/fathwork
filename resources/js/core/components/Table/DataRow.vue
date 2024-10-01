<template>
    <tr class="hover:bg-gray-100 dark:hover:bg-dark-body" :class="{
        'hidden md:table-row': ! noResponsive,
        'bg-gray-100 font-semibold dark:bg-neutral-600': isHeading
    }">
        <slot></slot>
    </tr>

    <div v-if="! noResponsive" class="md:hidden table-row dark:bg-dark-header hover:bg-gray-100 dark:hover:bg-dark-body" :class="{
        'space-y-2': spacing,
        'bg-gray-100 font-semibold dark:bg-neutral-600': isHeading,
    }">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'DataRow'
}
</script>

<script setup>
const props = defineProps({
    noResponsive: {
        type: Boolean,
        default: false
    },
    isHeading: {
        type: Boolean,
        default: false
    },
    spacing: {
        type: Boolean,
        default: true
    }
})
</script>
