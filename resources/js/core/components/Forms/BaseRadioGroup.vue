<template>
    <div :class="{
        'flex space-x-4': horizontal,
        'mt-4': topMargin,
        'mt-8': doubleTopMargin
    }">
        <BaseRadio
            :disabled="disabled"
            v-for="option in options"
            :key="option.value"
            :label="option.label"
            :value="option.value"
            :name="name"
            :modelValue="modelValue"
            @update:modelValue="updateInput"
        />
    </div>
    <FormError :error="error" />
</template>

<script>
export default {
    name: 'BaseRadioGroup',
    inheritAttrs: false
}
</script>

<script setup>
import { onMounted, reactive } from 'vue'

const emit = defineEmits(['update:modelValue', 'update:error', 'change'])

const props = defineProps({
    options: {
        type: Array,
        required: true
    },
    name: {
        type: String,
        required: true
    },
    modelValue: {
        type: [String, Number],
        required: true
    },
    error: {
        type: String,
        default: ''
    },
    horizontal: {
        type: Boolean,
        default: false
    },
    topMargin: {
        type: Boolean,
        default: false
    },
    doubleTopMargin: {
        type: Boolean,
        default: false
    },
    disabled: {
        type: Boolean,
        default: false
    }
})

const updateInput = ($event) => {
    emit('update:modelValue', $event)
    emit('update:error', '')
    emit('change')
}

</script>
