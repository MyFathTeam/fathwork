<template>
    <TransitionRoot
        :as="as"
        :appear="appear"
        :show="visibility"
        enter="transition transform duration-500 ease-out"
        :enter-from="getEnterFrom"
        enter-to="translate-x-0 opacity-100"
        leave="transition transform duration-500 ease-in"
        leave-from="translate-x-0 opacity-100"
        :leave-to="getLeaveTo"
    >
        <slot></slot>
    </TransitionRoot>
</template>

<script>
export default {
    name: 'ParentTransition'
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
        default: 'rtl'
    },
    duration: {
        type: Number,
        default: 500
    }
})

const getEnterFrom = computed(() => {
    if (props.direction === 'rtl') {
        return 'translate-x-4 opacity-0'
    }

    return '-translate-x-4 opacity-0'
})

const getLeaveTo = computed(() => {
    if (props.direction === 'rtl') {
        return 'translate-x-4 opacity-0'
    }

    return '-translate-x-4 opacity-0'
})
</script>
