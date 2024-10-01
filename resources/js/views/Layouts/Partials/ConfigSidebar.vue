<template>
    <aside class="bg-black rounded-lg py-6 sm:col-span-3 lg:col-span-2">
        <nav class="space-y-3">
            <router-link
                v-for="navigation in navigations"
                :key="navigation.name"
                :to="{
                    name: navigation.name
                }"
                class="group px-3 py-2 flex items-center text-sm font-medium hover:text-darken-secondary"
                :class="{
                    'text-darken-secondary': route.name === navigation.name,
                    'text-light-secondary': route.name !== navigation.name,
                }"
                :aria-current="route.name === navigation.name ? 'page' : undefined"
            >
                <span
                    class="shrink-0 ml-2 mr-3 w-6"
                    :class="[
                        navigation.meta.icon,
                    ]"
                    aria-hidden="true"
                />
                <span class="truncate">
                    {{ $trans(navigation.meta.label) }}
                </span>
            </router-link>
        </nav>
    </aside>
</template>

<script>
export default {
    name: 'ConfigSidebar'
}
</script>

<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";

const route = useRoute()
const store = useStore()

const navigations = computed(() => store.getters['navigation/configNavigations'])
</script>