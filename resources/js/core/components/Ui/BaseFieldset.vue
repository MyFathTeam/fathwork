<template>
    <fieldset class="border rounded-md border-solid border-gray-300 dark:border-gray-700 p-3">
        <legend class="text-sm p-2 border border-gray-300 font-semibold dark:border-gray-700 text-gray-800 dark:text-gray-300 rounded">
            <slot name="legend"></slot>
        </legend>
        <slot></slot>
    </fieldset>
</template>

<script>
export default {
    name: "BaseFieldset",
};
</script>

<script setup>
const props = defineProps({
});
</script>
