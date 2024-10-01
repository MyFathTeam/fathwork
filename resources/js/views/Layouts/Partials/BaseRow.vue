<template>
    <div class="grid"
        :class="{
            'grid-cols-2 gap-6': grids === 2,
            'grid-cols-3 gap-4': grids === 3,
            'grid-cols-4 gap-3': grids === 4,
        }"
    >
        <slot :grids="grids"></slot>
    </div>
</template>

<script>
export default {
    name: 'BaseRow'
}
</script>

<script setup>
const props = defineProps({
    grids: {
        type: Number,
        default: 1
    }
})
</script>