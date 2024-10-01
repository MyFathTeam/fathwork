<template>
    <TransitionChild
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
    </TransitionChild>
</template>

<script>
export default {
    name: 'ChildTransition'
}
</script>

<script setup>
import { computed } from "vue"
import { TransitionChild } from '@headlessui/vue'

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
    }
})

const getEnterFrom = computed(() => {
    if (props.direction === 'rtl') {
        return 'translate-x-10 opacity-0'
    }

    return '-translate-x-10 opacity-0'
})

const getLeaveTo = computed(() => {
    if (props.direction === 'rtl') {
        return 'translate-x-10 opacity-0'
    }

    return '-translate-x-10 opacity-0'
})
</script>
