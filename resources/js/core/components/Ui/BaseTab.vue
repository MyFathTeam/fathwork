<template>
    <BaseCard no-padding no-content-padding>
        <div class="">
            <nav class="px-4 -mb-px flex flex-col sm:flex sm:flex-row sm:space-x-8" aria-label="Tabs">
                <router-link v-for="tab in tabs" :key="tab.name" :to="{name: tab.path}" :class="[route.name === tab.path ? 'border-primary dark:border-secondary text-primary dark:text-secondary' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-400 hover:border-gray-300', 'group inline-flex items-center py-3 px-1 border-b-2 font-medium text-sm']">
                    <span><i v-if="tab.icon" :class="[tab.icon, route.name === tab.path ? 'text-primary dark:text-secondary' : 'text-gray-400 group-hover:text-gray-500 dark:group-hover:text-gray-300', '-ml-0.5 mr-2 h-5 w-5']"></i></span>
                    <span>{{ tab.label }}</span> <span v-if="tab.count" class="ml-1">({{tab.count}})</span>
                </router-link>
            </nav>
        </div>

        <div class="bg-white dark:bg-dark-header sm:rounded-bl-lg sm:rounded-br-lg text-sm text-gray-700 dark:text-gray-300">
            <slot></slot>
        </div>
    </BaseCard>
</template>

<script>
export default {
    name: 'BaseTab'
}
</script>

<script setup>
import { useRoute } from "vue-router"

const route = useRoute()

const props = defineProps({
    tabs: {
        type: Array,
        default: []
    }
})
</script>
