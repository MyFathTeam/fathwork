<template>
    <BaseCard no-padding no-content-padding v-if="meta.total">
        <div class="space-y-4">
            <slot></slot>
        </div>
    </BaseCard>

    <BaseCard v-if="meta.total === 0">
        <div class="flex flex-col justify-center items-center space-y-4 py-10 text-gray-500">
            <i class="fas fa-list fa-4x"></i>
            <p class="text-lg">{{$trans(module + '.module_title')}}</p>
            <p class="text-2xl text-gray-400 dark:text-gray-600" v-if="hasTrans(module + '.module_quote')">{{$trans(module + '.module_quote')}}</p>
            <p>{{$trans(module + '.module_description')}}</p>
            <p class="text-gray-400 dark:text-gray-600" v-if="hasTrans(module + '.module_example')">{{$trans(module + '.module_example')}}</p>
            <div>
                <slot name="actionButton"></slot>
            </div>
        </div>
    </BaseCard>
</template>

<script>
export default {
    name: 'CardList'
}
</script>

<script setup>
import { hasTrans } from "@core/helpers/trans"

const props = defineProps({
    header: {
        type: Array,
        default: []
    },
    footer: {
        type: Array,
        default: []
    },
    meta: {
        type: Object,
        default: {
            hasFooter: false,
            total: 0
        }
    },
    module: {
        type: String,
        default: ''
    },
})
</script>
