<template>
    <div>
        <BaseLabel :for="state.uniqueId">
            {{ label }} <span v-if="labelHint" class="ml-2" v-tooltip="labelHint"><i class="fas fa-question-circle"></i></span>
        </BaseLabel>
        <div class="mt-1">
            <QuillEditor
                ref="quillEditor"
                theme="snow"
                toolbar="essential"
                v-model:content="state.input"
                content-type="html"
                @update:content="updateInput"
            />
        </div>
        <FormError :error="error" />
    </div>
</template>

<script>
export default {
    name: 'BaseEditor',
    inheritAttrs: false
}
</script>

<script setup>
import { onMounted, reactive, ref, watch } from 'vue'
import { QuillEditor } from '@vueup/vue-quill'

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
    edit: {
        type: Boolean,
        default: false
    }
})

const quillEditor = ref()

const state = reactive({
    uniqueId: '',
    input: props.modelValue,
    set: false
})

const updateInput = ($event) => {
    emit('update:modelValue', quillEditor.value.getHTML())
    emit('update:error', '')
}

watch(
    () => props.modelValue,
    (value) => {
        if (props.edit && state.set === false && value) {
            state.input = value
            state.set = true
            quillEditor.value.setHTML(value)
        } else if (! props.edit && state.set === false && ! value) {
            state.input = value
            quillEditor.value.setHTML(value)
        }
    }
)

onMounted(async () => {
    state.uniqueId = props.id || Math.random()
        .toString(16)
        .slice(2)
})
</script>
