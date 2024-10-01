<template>
    <BaseSelect
        :multiple="multiple"
        :tags="tags"
        v-bind="$attrs"
        v-model="state.input"
        :filterResults="false"
        :minChars="1"
        :resolveOnLoad="resolveOnLoad()"
        :delay="500"
        :label-prop="props.labelProp"
        :value-prop="props.valueProp"
        :options="async function(query) {
            return await search(query);
        }"
        @change="updateInput"
        @selected="selected"
        @removed="removed"
        v-model:error="state.error"
    >
        <template #selectedOption="{ value }">
            <slot name="selectedOption" :value="value">
                {{value.name}}
            </slot>
        </template>

        <template #listOption="{ option }">
            <slot name="listOption" :option="option"></slot>
        </template>
    </BaseSelect>
</template>

<script>
export default {
    name: 'BaseSelectSearch'
}
</script>

<script setup>
import { reactive, watch, useSlots } from "vue"
import { useStore } from "vuex"

const store = useStore();
const slots = useSlots();

const emit = defineEmits(['update:modelValue', 'update:error', 'selected', 'removed'])

const props = defineProps({
    modelValue: {
        type: [String, Number, Array, Object],
        default: ''
    },
    multiple: {
        type: Boolean,
        default: false
    },
    tags: {
        type: Boolean,
        default: false
    },
    error: {
        type: String,
        default: ''
    },
    labelProp: {
        type: String,
        default: 'name'
    },
    valueProp: {
        type: String,
        default: 'uuid'
    },
    searchAction: {
        type: String,
        required: true
    },
    searchKey: {
        type: String,
        default: 'name'
    },
    additionalSearchQuery: {
        type: Object,
        default() {
            return {}
        }
    },
    initSearch: {
        type: [String, Array],
        default: ''
    },
    initSearchKey: {
        type: String,
        default: 'uuid'
    }
})

const state = reactive({
    initSearchLoaded: false,
    input: props.modelValue,
    error: props.error
})

const updateInput = (value) => {
    emit('update:modelValue', value)
    emit('update:error', '')
}

const resolveOnLoad = () => {
    if (Array.isArray(props.initSearch)) {
        if (props.initSearch.length > 0) {
            return true;
        }
        return false;
    }

    return props.initSearch ? true : false
}

const search = async (query) => {
    let params = {}

    for (const [key, value] of Object.entries(props.additionalSearchQuery)) {
        params[key] = value
    }

    if (! _.isEmpty(props.initSearch) && ! state.initSearchLoaded) {
        params[props.initSearchKey] = props.initSearch

        if (! params[props.initSearchKey]) {
            return []
        }
    } else {
        params[props.searchKey] = query

        if (! params[props.searchKey]) {
            return []
        }
    }

    return await store.dispatch(props.searchAction, {
        params
    }).then((response) => {
        state.initSearchLoaded = true
        return response.data
    }).catch((e) => {})
}

const selected = (selectedOption) => {
    emit('selected', selectedOption)
}

const removed = (removedOption) => {
    emit('removed', removedOption)
}

watch(
    () => [props.modelValue, props.error],
    (value) => {
        state.input = value[0]
        state.error = value[1]
    }
)
</script>
