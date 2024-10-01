<template>
    <div
        class="
            relative
            flex
            justify-end
            items-center
        ">
        <VMenu placement="left-end" :triggers="['hover', 'focus', 'click']" :autoHide="true">
            <div
                class="
                    bg-transparent
                    dark:bg-dark-header
                    inline-flex
                    items-center
                    justify-center
                    text-gray-400
                    rounded-full
                    hover:text-gray-500
                "
                :class="{
                    'h-5 w-5': slim,
                    'h-8': ! slim,
                    'w-8': ! noWidth,
                }">
                <EllipsisVerticalIcon
                    class="w-5 h-5"
                />
            </div>

            <template #popper>
                <div
                    class="
                      bg-white
                      dark:bg-dark-header
                        dark:border
                        dark:border-gray-700
                        divide-y divide-gray-200 dark:divide-gray-600
                ">
                    <slot></slot>
                </div>
            </template>
        </VMenu>
    </div>
</template>

<script>
export default {
    name: 'FloatingMenu'
}
</script>

<script setup>
const props = defineProps({
    slim: {
        type: Boolean,
        default: false
    },
    noWidth: {
        type: Boolean,
        default: false
    },
    topMargin: {
        type: Boolean,
        default: false
    },
    doubleTopMargin: {
        type: Boolean,
        default: false
    },
    rightMargin: {
        type: Boolean,
        default: true
    }
})
</script>
