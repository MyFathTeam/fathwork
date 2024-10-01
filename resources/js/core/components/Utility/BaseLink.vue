<template>
    <div class="text-sm">
        <a v-if="to"
            @click="router.push({name: to})"
            class="
                cursor-pointer
                font-medium
                text-primary dark:text-gray-400
                hover:text-dark-primary dark:focus:text-gray-300
            "
        >
            <slot></slot>
        </a>
        <a v-if="!to"
            :href="href"
            class="
                font-medium
                text-primary dark:text-gray-400
                hover:text-dark-primary dark:focus:text-gray-300
            "
        >
            <slot></slot>
        </a>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const props = defineProps({
    href: {
        type: String,
        default: '#'
    },
    to: {
        type: String,
        default: null
    }
})
</script>