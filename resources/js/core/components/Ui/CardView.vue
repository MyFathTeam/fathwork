<template>
    <div class="relative rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-dark-header bg-white hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 shadow-lg overflow-hidden">
        <div class="px-4 py-3 flex items-center space-x-3">
            <div class="flex-shrink-0 cursor-pointer" v-if="imgSrc" @click="router.push(path)">
                <img class="h-16 w-16 rounded-full" :src="imgSrc" alt="" />
            </div>
            <div class="flex-1 min-w-0">
                <div class="focus:outline-none space-y-1">
                    <!-- <span class="absolute inset-0" aria-hidden="true" /> -->
                    <div class="flex justify-between items-start">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-400 cursor-pointer" @click="router.push(path)">
                            <slot name="title"></slot>
                        </p>

                        <div class="absolute right-2 top-2">
                            <slot name="action"></slot>
                        </div>
                    </div>
                    <slot></slot>
                </div>
            </div>
        </div>
        <div>
            <slot name="progress"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CardView'
}
</script>

<script setup>
import { useRouter } from "vue-router"

const router = useRouter()

const props = defineProps({
    imgSrc: {
        type: String,
        default: ''
    },
    path: {
        type: Object,
        default() {
            return {}
        }
    }
})
</script>
