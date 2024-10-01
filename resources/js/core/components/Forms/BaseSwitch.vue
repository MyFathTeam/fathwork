<template>
    <SwitchGroup as="div" class=""
        :class="{
            'flex items-center': ! vertical,
            'mt-8': topMargin,
            'space-x-4': reverse,
            'justify-between': ! reverse
        }"
        >
        <span class="flex flex-col" v-if="! reverse">
            <SwitchLabel
                as="span"
                class="text-sm font-medium text-gray-900 dark:text-gray-400"
                passive
                >{{label}}</SwitchLabel
            >
            <SwitchDescription as="span" class="text-sm text-gray-500" v-if="description"
                >{{description}}</SwitchDescription
            >
        </span>
        <Switch
            as="span"
            v-model="state.input"
            @update:modelValue="updateInput"
            :name="name"
            :class="[
                toBoolean(state.input) ? 'bg-primary dark:bg-dark-body dark:border-gray-700' : 'bg-gray-200 dark:bg-gray-700 dark:border-dark-body',
                vertical ? 'mt-4' : '',
                'relative inline-flex shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none',
            ]"
        >
            <span
                aria-hidden="true"
                :class="[
                    toBoolean(state.input) ? 'translate-x-5' : 'translate-x-0',
                    'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                ]"
            />
        </Switch>
        <span class="flex flex-col" v-if="reverse">
            <SwitchLabel
                as="span"
                class="text-sm font-medium text-gray-900 dark:text-gray-400"
                passive
                >{{label}}</SwitchLabel
            >
        </span>
    </SwitchGroup>
    <FormError :error="error" />
</template>

<script>
export default {

}
</script>

<script setup>
import { reactive, onMounted, watch } from "vue"
import { toBoolean } from "@core/helpers/string"
import {
    Switch,
    SwitchDescription,
    SwitchGroup,
    SwitchLabel,
} from "@headlessui/vue";

const emit = defineEmits(['update:modelValue', 'update:error', 'change'])

const props = defineProps({
    name: {
        type: String,
        default: '',
        required: true
    },
    label: {
        type: String,
        default: '',
    },
    description: {
        type: String,
        default: ''
    },
    modelValue: {
        type: [Boolean, String, Number],
        default: ''
    },
    error: {
        type: String,
        default: ''
    },
    reverse: {
        type: Boolean,
        default: false
    },
    vertical: {
        type: Boolean,
        default: false,
    },
    topMargin: {
        type: Boolean,
        default: false
    }
})

const state = reactive({
    uniqueId: '',
    input: props.modelValue
})

const updateInput = ($event) => {
    emit('update:modelValue', toBoolean(state.input))
    emit('update:error', '')
}

watch(
    () => props.modelValue,
    (value) => {
        state.input = toBoolean(value)
    }
)

onMounted(() => {
    state.uniqueId = props.id || Math.random()
            .toString(16)
            .slice(2)
})
</script>
