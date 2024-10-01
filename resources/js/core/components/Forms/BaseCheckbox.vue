<template>
    <div class="flex items-center">
        <input
            :id="state.uniqueId"
            v-bind="$attrs"
            :checked="modelValue"
            @change="updateInput"
            type="checkbox"
            :disabled="disabled"
            class="
                h-4
                w-4
                text-primary dark:text-dark-body
                focus:ring-0
                border-primary dark:border-gray-700
                rounded
            "
            :class="{
                'cursor-pointer': ! disabled,
                'text-gray-400 dark:text-gray-500': disabled
            }"
        />
        <label :for="state.uniqueId" class="ml-2 block text-sm text-gray-900 dark:text-gray-400" :class="{
            'cursor-pointer': ! disabled
        }">
            <div class="flex justify-between">
                {{label}} <span v-if="labelHint" class="ml-2" v-tooltip="labelHint"><i class="fas fa-question-circle"></i></span>
            </div>
        </label>
    </div>
    <FormError :error="error" />
</template>

<script>
export default {
    name: 'BaseCheckbox',
    inheritAttrs: false
}
</script>

<script setup>
import { onMounted, reactive } from 'vue'

const emit = defineEmits(['update:modelValue', 'update:error'])

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    labelHint: {
        type: String,
        default: '',
    },
    modelValue: {
        type: Boolean,
        default: false
    },
    error: {
        type: String,
        default: ''
    },
    disabled: {
        type: Boolean,
        default: false
    }
})

const state = reactive({
    uniqueId: ''
})

const updateInput = ($event) => {
    emit('update:modelValue', $event.target.checked)
    emit('update:error', '')
}

onMounted(() => {
    state.uniqueId = props.id || Math.random()
            .toString(16)
            .slice(2)
})
</script>
