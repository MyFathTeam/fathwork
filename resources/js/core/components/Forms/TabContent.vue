<template>
    <div v-show="isActive">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: "TabContent",
}
</script>

<script setup>
import { ref, inject, watch, onBeforeMount } from "vue"
import { TransitionChild } from "@headlessui/vue"

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        default: ''
    },
    step: {
        type: String
    },
    isSelected: Boolean,
    beforeChange: {
        type: Function,
        default() {
            return true
        }
    },
    afterChange: {
        type: Function,
        default() {
            return true
        }
    }
})

const index = ref(0)
const isActive = ref(false)

const parentState = inject("TabsProvider")

watch(
    () => parentState.selectedIndex,
    () => {
        isActive.value = index.value === parentState.selectedIndex
    }
)

onBeforeMount(() => {
    index.value = parentState.count
    parentState.count++
    isActive.value = index.value === parentState.selectedIndex
})
</script>
