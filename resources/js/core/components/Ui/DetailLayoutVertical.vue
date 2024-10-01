<template>
    <div class="mt-8 mx-auto max-w-full grid grid-cols-1 gap-6 lg:grid-flow-col-dense lg:grid-cols-3">
        <div class="space-y-6 flex flex-col lg:col-start-1 lg:col-span-2">
            <section class="space-y-4 flex-1">
                <slot></slot>
            </section>
        </div>
        <section class="flex flex-col lg:col-start-3 lg:col-span-1 space-y-4">
            <slot name="detail"></slot>
        </section>
    </div>
</template>

<script>
export default {
    name: 'DetailLayoutVertical'
}
</script>

<script setup>
import { useSlots } from "vue"

const slots = useSlots()

const props = defineProps({})
</script>
