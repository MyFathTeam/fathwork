<template>
    <div class="space-y-6 lg:px-0 lg:col-span-9 relative"
        :class="{
            '': ! noContentPadding
        }"
        ref="loadingContainer"
    >
        <div
            class="relative"
            :class="{}"
        > <!-- 'shadow sm:rounded-md sm:overflow-hidden': ! noBorder -->
            <div v-if="$slots.title || $slots.action" class="flex justify-between px-4 py-2 bg-white dark:bg-dark-header border-b border-gray-200 dark:border-gray-700 sm:rounded-tl-lg sm:rounded-tr-lg">
                <div v-if="$slots.title" class="text-base font-semibold text-gray-800 dark:text-gray-400 leading-7 sm:text-lg sm:truncate">
                    <slot name="title"></slot>
                </div>
                <div v-if="$slots.action" class="flex items-center text-right">
                    <slot name="action"></slot>
                </div>
            </div>
            <div class="bg-white dark:bg-dark-header"
                :class="{
                    'px-2 sm:p-2': lessPadding,
                    'px-4 sm:p-6': ! lessPadding && ! noPadding,
                    'py-6': ! noContentPadding,
                    'pb-6': bottomContentPadding,
                    'pt-6': topContentPadding,
                    'sm:rounded-tl-lg sm:rounded-tr-lg': ! $slots.title && ! $slots.action,
                    'sm:rounded-bl-lg sm:rounded-br-lg': ! $slots.footer && ! $slots.progress,
                }"
            >
                <slot></slot>
            </div>
            <div v-if="$slots.footer" class="px-4 py-3 bg-white dark:bg-dark-header text-right sm:px-6 sm:rounded-bl-lg sm:rounded-br-lg">
                <slot name="footer"></slot>
            </div>
            <div v-if="$slots.progress" class="bg-white dark:bg-dark-header text-right sm:rounded-bl-lg sm:rounded-br-lg">
                <slot name="progress"></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'BaseCard'
}
</script>

<script setup>
import { useSlots, ref, computed, watch } from "vue"
import { useLoading } from 'vue-loading-overlay'

const slots = useSlots()

const $loading = useLoading({});

const props = defineProps({
    noBorder: {
        type: Boolean,
        default: false
    },
    lessPadding: {
        type: Boolean,
        default: false
    },
    noPadding: {
        type: Boolean,
        default: false
    },
    noContentPadding: {
        type: Boolean,
        default: false
    },
    bottomContentPadding: {
        type: Boolean,
        default: false
    },
    topContentPadding: {
        type: Boolean,
        default: false
    },
    isLoading: {
        type: Boolean,
        default: false
    },
})

const loadingContainer = ref(false)
let loader = null

const isLoading = computed(() => {
    return props.isLoading
})

watch(isLoading, (value, prevvalue) => {
    if(value) {
        loader = $loading.show({ container: loadingContainer.value })
    } else if(loader){
        loader.hide()
    }
})
</script>
