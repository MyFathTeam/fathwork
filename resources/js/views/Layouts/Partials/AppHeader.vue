<template>
    <div
        class="
            relative
            z-10
            shrink-0 flex justify-between
            h-16
            bg-black dark:bg-dark-header
            dark:border-b dark:border-gray-700
        "
    >
        <div class="flex">
            <div class="flex items-center">
                <img :src="getLightLogo" class="hidden sm:block h-12 ml-4 mr-2" />
                <img :src="getIcon" class="sm:hidden h-12 mx-2" />
                <button
                    type="button"
                    class="
                        h-full w-full
                        px-4
                        text-gray-500
                        focus:outline-none
                        hidden lg:block
                    "
                    v-tooltip="$trans('global.toggle', {attribute: $trans('general.sidebar')})"
                    @click="setUserSidebar"
                >
                    <span class="sr-only">Pinned Sidebar</span>
                    <i class="far fa-circle h-6 w-6" v-if="! isPinnedSidebar" aria-hidden="true"></i>
                    <i class="fas fa-dot-circle h-6 w-6" v-else aria-hidden="true"></i>
                </button>
                <BaseBadge class="hidden sm:block" v-if="! mode" design="danger" :label="$trans('general.demo')" />
                <button
                    type="button"
                    class="
                        h-full w-full
                        px-2 sm:px-4
                        text-gray-500
                        focus:outline-none
                        lg:hidden
                    "
                    @click="setMobileSidebar(true)"
                >
                    <span class="sr-only">Open Mobile Sidebar</span>
                    <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                </button>
            </div>
        </div>
        <div class="flex justify-between items-center space-x-4 px-4">
            <div v-if="canStoreConfig">
                <router-link :to="{name: 'Config'}">
                    <i class="text-white fas fa-cog"></i>
                </router-link>
            </div>
            <div class="hidden sm:block" v-if="maintenanceMode" v-tooltip="$trans('general.under_maintenance')">
                <i class="fas fa-circle h-4 w-4 text-danger"></i>
            </div>
            <div class="flex items-center">
                <ProfileDropdown />
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue"
import { useStore } from "vuex"
import { Bars3Icon } from "@heroicons/vue/20/solid";
import { perform, getConfig, getAuthUser } from "@core/helpers/action"

const store = useStore()

const canStoreConfig = perform('config:store')

const getLightLogo = getConfig('assets.logoLight')
const getIcon = getConfig('layout.display').value == 'dark' ? getConfig('assets.iconLight') : getConfig('assets.icon')
const mode = getConfig('system.mode')
const maintenanceMode = getConfig('system.enableMaintenanceMode')
const isPinnedSidebar = computed(() => store.getters['layout/getSidebarType'] === 'pinned')

const setMobileSidebar = (value) => {
    store.dispatch('layout/setMobileSidebar', value)
}

const setUserLayout = (payload) => {
    store.dispatch('layout/setUserLayout', payload)
}

const setUserSidebar = () => {
    let value = isPinnedSidebar.value ? 'mini' : 'pinned'
    setUserLayout({sidebar: value})
}
</script>
