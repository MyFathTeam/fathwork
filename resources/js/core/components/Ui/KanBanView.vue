<template>
    <div class="scroller-thin-x scroller-hidden scrollbar-track-transparent scrollbar-thumb-body dark:scrollbar-thumb-dm-body">
        <div class="flex space-x-2">
            <slot></slot>
            <div class="flex-shrink-0 flex flex-col p-3 w-80 bg-gray-100 dark:bg-neutral-800 rounded-md" v-if="addList">
                <h3 class="text-sm font-medium text-gray-900 dark:text-gray-300 mb-3">
                    <span class="text-gray-600 dark:text-gray-500">
                        <slot name="addListTitle"></slot>
                    </span>
                </h3>

                <slot name="addListForm"></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'KanBanView'
}
</script>

<script setup>
const props = defineProps({
    addList: {
        type: Boolean,
        default: false
    }
})
</script>
