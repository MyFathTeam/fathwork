<template>
    <BaseLabel class="my-2">
        <div>
            <strong>{{label}}</strong>
            <span class="ml-2" v-if="size">{{$trans('global.recommended_size', {attribute: size})}}</span>
        </div>
    </BaseLabel>
</template>

<script>
export default {
    name: 'ImageLabel'
}
</script>

<script setup>
const props = defineProps({
    label: {
        type: String,
        required: true
    },
    size: {
        type: String,
        default: ""
    }
})
</script>