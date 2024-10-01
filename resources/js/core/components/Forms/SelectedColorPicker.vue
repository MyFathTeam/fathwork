<template>
    <div>
        <div class="flex justify-between">
            <BaseLabel :for="state.uniqueId" v-if="label">
                {{ label }} <span v-if="labelHint" class="ml-2" v-tooltip="labelHint"><i class="fas fa-question-circle"></i></span>
            </BaseLabel>
            <slot name="additional-label"></slot>
        </div>
        <div class="mt-1 flex flex-wrap items-center">
            <span
                v-for="color in colors"
                :key="color" class="h-6 w-6 mr-1 mt-1 rounded-full cursor-pointer"
                :class="{
                    'h-8 w-8': state.selectedColor === color
                }"
                :style="`background-color:${color}`"
                @click="changeColor(color)">
                    &nbsp;
            </span>
        </div>
        <FormError :error="error" />
    </div>
</template>

<script>
export default {
    name: 'SelectedColorPicker'
}
</script>

<script setup>
import { reactive, onMounted, watch } from 'vue'

const emit = defineEmits(['update:modelValue', 'update:error'])

const props = defineProps({
    id: {
        type: String,
        default: ''
    },
    colors: {
        type: Array,
        default: ['#fda4af', '#db2777', '#c084fc', '#581c87', '#4f46e5', '#312e81', '#0369a1', '#22d3ee', '#5eead4', '#10b981', '#15803d', '#14532d', '#fef08a', '#facc15', '#d97706', '#9a3412', '#7f1d1d', '#78716c', '#3f3f46', '#4b5563', '#94a3b8']
    },
    modelValue: {
        type: String,
        default: ''
    },
    label: {
        type: String,
        default: ''
    },
    labelHint: {
        type: String,
        default: ''
    },
    error: {
        type: String,
        default: ''
    }
});

const state = reactive({
    uniqueId: '',
    selectedColor: props.modelValue,
})

const changeColor = (color) => {
    state.selectedColor = color
    emit('update:modelValue', color)
    emit('update:error', '')
}

onMounted(() => {
    state.uniqueId = props.id || Math.random()
        .toString(16)
        .slice(2)

    state.selectedColor = props.modelValue
})

watch(() => props.modelValue, (value) => {
    if (value) {
        state.selectedColor = value
    }
})
</script>