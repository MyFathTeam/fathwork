<template>
    <span>{{getValue}}</span>
</template>

<script>
export default {
    name: 'ShowDateTime'
}
</script>

<script setup>
import { inject, computed } from "vue"
import { useStore } from "vuex"

const $cal = inject("$cal");

const props = defineProps({
    value: {
        type: String,
        default: ''
    },
    as: {
        type: String,
        default: 'date' // date|time|datetime
    },
    convert: {
        type: Boolean,
        default: false
    }
})

const store = useStore()

const getValue = computed(() => {
    if (! props.convert) {
        return props.value
    }

    return $cal.toUserTimezone(props.value, props.as)
})
</script>