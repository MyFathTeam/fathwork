<template>
    <TransitionRoot as="template" :show="visibility">
        <div
            class="fixed z-50 max-w-xl inset-0 overflow-y-auto"
            @close="emit('close')"
        >
            <div
                class="
                    flex
                    items-center
                    justify-center
                    min-h-screen
                    pt-4
                    px-4
                    pb-20
                    text-center
                    sm:block sm:p-0
                "
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div
                        class="
                            fixed
                            inset-0
                            bg-gray-500 bg-opacity-75
                            transition-opacity
                        "
                    />
                </TransitionChild>

                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                    aria-hidden="true"
                    >&#8203;</span
                >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to="opacity-100 translate-y-0 sm:scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 sm:scale-100"
                    leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        class="
                            inline-block
                            align-bottom
                            bg-white dark:bg-dark-body
                            rounded-lg
                            text-left
                            overflow-hidden
                            shadow-xl
                            transform
                            transition-all
                            sm:my-8 sm:align-middle sm:max-w-lg w-full sm:w-9/12
                        "
                    >
                        <div>
                            <h3
                                class="
                                    flex
                                    justify-between
                                    items-center
                                    p-4
                                    text-lg
                                    leading-6
                                    font-medium
                                    text-gray-900 dark:text-gray-400
                                    border-b border-gray-200 dark:border-gray-700
                                "
                            >
                                <div>
                                    <slot name="title"></slot>
                                </div>
                                <i class="fas fa-times text-gray-400 cursor-pointer" @click="emit('close')"></i>
                            </h3>
                            <div class="mt-2 px-4" v-if="$slots.description">
                                <p class="text-sm text-gray-500">

                                </p>
                            </div>
                            <div class="p-4">
                                <slot></slot>
                            </div>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </div>
    </TransitionRoot>
</template>

<script>
export default {
    name: "BaseModal",
};
</script>

<script setup>
import { useSlots } from "vue"
import {
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";

const slots = useSlots()

const emit = defineEmits(["close"]);

const props = defineProps({
    visibility: {
        type: Boolean,
        default: false,
    },
});
</script>
