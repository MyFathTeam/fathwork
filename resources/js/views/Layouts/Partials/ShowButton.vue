<template>
    <div class="flex justify-between"
        :class="{
            'mt-4': topMargin,
            'px-2 pt-6 bg-white': padding
        }"
    >
        <div class="space-x-4">
            <BaseButton design="secondary" @click="router.go(-1)">
                {{$trans("general.back")}}
            </BaseButton>
        </div>
        <div class="space-x-4">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ShowButton'
}
</script>

<script setup>
import { useRouter } from "vue-router"

const router = useRouter()

const props = defineProps({
    padding: {
        type: Boolean,
        default: false
    },
    topMargin: {
        type: Boolean,
        default: false
    }
})
</script>
