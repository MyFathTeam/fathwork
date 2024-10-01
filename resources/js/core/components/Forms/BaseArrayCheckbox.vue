<template>
    <div class="flex items-center">
        <input
            :id="state.uniqueId"
            v-bind="$attrs"
            :checked="checked"
            @change="updateInput"
            type="checkbox"
            class="
                h-4
                w-4
                text-primary dark:text-dark-body
                focus:ring-0
                border-primary dark:border-gray-700
                cursor-pointer
                rounded
            "
        />
        <label :for="state.uniqueId" class="ml-2 block text-sm text-gray-900 dark:text-gray-400">
            <div class="flex justify-between">
                {{label}} <span v-if="labelHint" class="ml-2" v-tooltip="labelHint"><i class="fas fa-question-circle"></i></span>
            </div>
        </label>
    </div>
    <FormError :error="error" />
</template>

<script>
export default {
    name: 'BaseArrayCheckbox',
    inheritAttrs: false
}
</script>

<script setup>
import { onMounted, reactive, computed } from 'vue'

const emit = defineEmits(['update:items', 'update:error'])

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    labelHint: {
        type: String,
        default: '',
    },
    items: {
        type: Array,
        default: []
    },
    value: {
        type: String,
        default: ''
    },
    error: {
        type: String,
        default: ''
    }
})

const checked = computed(() => props.items.includes(props.value));

const state = reactive({
    uniqueId: ''
})

const updateInput = ($event) => {
    let updatedItems = [...props.items];
    if (checked.value) {
      updatedItems.splice(updatedItems.indexOf(props.value), 1);
    } else {
      updatedItems.push(props.value);
    }
    emit('update:items', updatedItems)
    emit('update:error', '')
}

onMounted(() => {
    state.uniqueId = props.id || Math.random()
            .toString(16)
            .slice(2)
})
</script>
