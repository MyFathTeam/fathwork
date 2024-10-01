<template>
    <div
        class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 dark:bg-dark-body py-6 sm:py-12"
    >
        <div
            class="absolute inset-0 bg-site-background bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]" v-if="! hasDarkMode"
        ></div>
        <div
            class="relative container bg-white dark:bg-dark-header px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 dark:ring-gray-400/5 sm:mx-auto sm:rounded-lg sm:px-10"
        >
            <div class="mx-auto max-w-full">
                <img v-if="route.meta?.showLogo" :src="getLogo" class="h-20 mb-4" alt="Fathforce" />
                <router-view />
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<script setup>
import { computed } from "vue"
import { useRoute } from "vue-router"
import { getConfig } from "@core/helpers/action";

const route = useRoute()

const hasDarkMode = computed(() => getConfig('layout.display').value == 'dark' ? true : false)
const getLogo = hasDarkMode.value ? getConfig('assets.logoLight') : getConfig('assets.logo')
</script>
