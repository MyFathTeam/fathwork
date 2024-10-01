<template>
  <md-editor
    ref="mdeditor"
    :placeholder="placeholder"
    v-model="state.input"
    @change="updateInput"
    language="en-US"
    :theme="getDisplay === 'dark' ? 'dark' : 'light'"
    :htmlPreview="false"
    :preview="false"
    :showCodeRowNumber="true"
    :footers="[]"
    :toolbars="toolbarOption"
    @on-upload-img="onUploadImg"
  />
  <FormError :error="error" />
</template>

<script setup>
import { onMounted, computed, reactive, ref, watch } from 'vue'
import { useStore } from "vuex"
import { getAuthUser } from "@core/helpers/action"
import MdEditor from 'md-editor-v3';

const store = useStore()

const emit = defineEmits(['update:modelValue', 'update:error'])

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
    },
    error: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: ''
    },
    toolbar: {
        type: String,
        default: 'full'
    }
})

const getDisplay = getAuthUser('preference.layout.display')

const toolbarOption = computed(() => {
    if (props.toolbar == 'full') {
        return [
            'bold',
            'underline',
            'italic',
            '-',
            'title',
            'strikeThrough',
            'sub',
            'sup',
            'quote',
            'unorderedList',
            'orderedList',
            '-',
            'codeRow',
            'code',
            'link',
            'image',
            'table',
            '-',
            'revoke',
            'next',
            '=',
            'preview',
            'fullscreen',
        ]
    } else if (props.toolbar == 'mini') {
        return [
            'bold',
            'underline',
            'italic',
            '-',
            'title',
            'strikeThrough',
            'unorderedList',
            'orderedList',
            'link',
        ]
    }
})

const mdeditor = ref(null)

const state = reactive({
    uniqueId: '',
    input: props.modelValue,
})

const updateInput = (value) => {
    emit('update:modelValue', value)
    emit('update:error', '')
}

const resize = () => {
    mdeditor.value.style.height = mdeditor.value.scrollHeight + "px";
}

const onUploadImg = async (files, callback) => {

    let formData = new FormData();
    formData.append('image', files[0]);

    await store.dispatch('image/upload', {
        path: 'images/upload',
        data: formData
    }).then(response => {
        callback([response.url])
    }).catch(e => {
        console.log(e)
    })
}

watch(
    () => props.modelValue,
    (value) => {
        state.input = value
    }
)

onMounted(async () => {
    state.uniqueId = props.id || Math.random()
        .toString(16)
        .slice(2)
})
</script>