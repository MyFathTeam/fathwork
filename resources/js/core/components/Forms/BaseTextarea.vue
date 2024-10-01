<template>
    <div>
        <BaseLabel :for="state.uniqueId" v-if="label">
            {{ label }} <span v-if="labelHint" class="ml-2" v-tooltip="labelHint"><i class="fas fa-question-circle"></i></span>
        </BaseLabel>
        <div :class="{
            'mt-1': label
        }">
            <textarea
            ref="textarea"
            :id="state.uniqueId"
            v-bind="$attrs"
            :placeholder="placeholder || label"
            :rows="rows" class="w-full shadow-sm block bg-inherit focus:ring-0 dark:focus:ring-gray-700 focus:border-primary dark:focus:border-gray-200 text-sm border-0 border-gray-300 dark:border-gray-700 dark:text-gray-200" :class="{
                'border-b-2': ! invisible,
            }"
            @input="updateInput"
            :value="modelValue"
            />
        </div>
        <FormError :error="error" />
    </div>
</template>

<script>
export default {
    name: 'BaseTextarea',
    inheritAttrs: false,
}
</script>

<script setup>
import { onMounted, ref, reactive } from 'vue'

const emit = defineEmits(['update:modelValue', 'update:error'])

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    rows: {
        type: Number,
        default: 3
    },
    labelHint: {
        type: String,
        default: '',
    },
    placeholder: {
        type: String,
        default: ''
    },
    modelValue: {
        type: [String, Number],
        default: ''
    },
    error: {
        type: String,
        default: ''
    },
    invisible: {
        type: Boolean,
        default: false
    },
})

const textarea = ref(null)

const state = reactive({
    uniqueId: ''
})

const updateInput = ($event) => {
    resize()
    emit('update:modelValue', $event.target.value)
    emit('update:error', '')
}

const resize = () => {
    textarea.value.style.height = "20px";
    textarea.value.style.height = textarea.value.scrollHeight + "px";
}

onMounted(() => {
    state.uniqueId = props.id || Math.random()
        .toString(16)
        .slice(2)
})
</script>
