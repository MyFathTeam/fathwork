<template>
    <div class="mt-1 text-xs text-primary" :id="id">
        <slot></slot>
    </div>
</template>

<script setup>
const props = defineProps({
    id: {
        type: String,
        required: false
    },
})
</script>
