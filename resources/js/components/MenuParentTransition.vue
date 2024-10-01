<template>
    <TransitionRoot
        :as="as"
        :appear="appear"
        :show="visibility"
        enter="transition transform duration-200 ease-out"
        :enter-from="getEnterFrom"
        enter-to="translate-y-0 opacity-100"
        leave="transition transform duration-200 ease-in"
        leave-from="translate-y-0 opacity-100"
        :leave-to="getLeaveTo"
    >
        <slot></slot>
    </TransitionRoot>
</template>

<script>
export default {
    name: 'MenuParentTransition'
}
</script>

<script setup>
import { computed } from "vue"
import { TransitionRoot } from '@headlessui/vue'

const props = defineProps({
    visibility: {
        type: Boolean,
        default: false
    },
    appear: {
        type: Boolean,
        default: false
    },
    as: {
        type: String,
        default: 'div'
    },
    direction: {
        type: String,
        default: 'up'
    },
    duration: {
        type: Number,
        default: 200
    }
})

const getEnterFrom = computed(() => {
    if (props.direction === 'up') {
        return 'translate-y-4 opacity-0'
    }

    return '-translate-y-4 opacity-0'
})

const getLeaveTo = computed(() => {
    if (props.direction === 'up') {
        return 'translate-y-4 opacity-0'
    }

    return '-translate-y-4 opacity-0'
})
</script>
