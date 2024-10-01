<template>
    <div v-if="active"
        class="rounded-md"
        :class="{
            'p-4': size === 'sm',
            'p-2': size === 'xs',
            'bg-success': design === 'success',
            'bg-warning': design === 'warning',
            'bg-danger': design === 'error',
            'bg-info': design === 'info',
        }"
    >
        <div class="flex">
            <div class="shrink-0">
                <component v-if="icon" :is="getIcon" class="h-5 w-5 text-success-label" aria-hidden="true" />
            </div>
            <div class="ml-3">
                <div
                    class="text-sm font-normal"
                    :class="{
                        'text-success-label': design === 'success',
                        'text-warning-label': design === 'warning',
                        'text-danger-label': design === 'error' || design === 'danger',
                        'text-info-label': design === 'info',
                    }"
                >
                    <slot></slot>
                </div>
            </div>
            <div class="ml-auto pl-3" v-if="close">
                <XMarkIcon class="h-5 w-5 text-success-label cursor-pointer" @click="active = false" aria-hidden="true" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BaseAlert",
    computed: {
        getIcon() {
            if (this.design === 'success') {
                return 'CheckCircleIcon';
            } else if (this.design === 'warning') {
                return 'ExclamationCircleIcon';
            } else if (this.design === 'error' || this.design === 'danger') {
                return 'XCircleIcon';
            } else if (this.design === 'info') {
                return 'InformationCircleIcon';
            }
        }
    }
};
</script>

<script setup>
import { ref } from "vue"

const props = defineProps({
    design: {
        type: String,
        validator(value) {
            return [
                "primary",
                "secondary",
                "info",
                "success",
                "warning",
                "error",
                "danger",
            ].includes(value);
        },
        default: "success",
    },
    close: {
        type: Boolean,
        default: false
    },
    icon: {
        type: Boolean,
        default: true
    },
    size: {
        type: String,
        validator(value) {
            return ["xs", "sm"].includes(value)
        },
        default: 'sm'
    },
});

const active = ref(true)
</script>
