<template>
    <div :class="class">
        <BaseDataList :label="label" :revert="revert" :font-size="fontSize">
            <slot name="label">{{label}}</slot>
        </BaseDataList>
        <BaseDataDef :revert="revert" :font-size="fontSize">
            <slot></slot>
        </BaseDataDef>
    </div>
</template>

<script>
export default {
    name: 'BaseDataView'
}
</script>

<script setup>
const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    class: {
        type: String,
        default: 'sm:col-span-1'
    },
    revert: {
        type: Boolean,
        default: false
    },
    fontSize: {
        type: String,
        validator(value) {
            return ["xs", "sm"].includes(value)
        },
        default: 'sm'
    }
})
</script>
