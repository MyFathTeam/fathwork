<template>
    <MobileSidebar></MobileSidebar>

    <div class="hidden lg:flex lg:shrink-0">
        <div @mouseover="sidebarMouseOver" @mouseleave="sidebarMouseLeave"
            class="
                flex flex-col transition-all duration-200 ease-out
                border-r border-primary dark:border-gray-700
                pt-5
                pb-4
                bg-primary dark:bg-dark-header
            "
            :class="{
                'absolute top-0 left-0 z-40 h-full': ! isPinnedSidebar,
                'w-16': isMiniSidebar,
                'w-64': isFullSidebar || isPinnedSidebar
            }"
        >
            <div class="h-0 flex-1 flex flex-col overflow-x-hidden scroller-thin-y scroller-hidden">

                <nav class="px-0 mt-6">
                    <AppNavigation />
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue"
import { useStore } from "vuex"

const store = useStore()

const sidebarType = computed(() => store.getters['layout/getSidebarType'])
const isMiniSidebar = computed(() => sidebarType.value === 'mini')
const isFullSidebar = computed(() => sidebarType.value === 'full')
const isPinnedSidebar = computed(() => sidebarType.value === 'pinned')
const showMenuName = computed(() => isFullSidebar.value || isPinnedSidebar.value)

const sidebarMouseOver = () => {
    if (! isPinnedSidebar.value) {
        store.dispatch('layout/setSidebarType', 'full')
    }
}

const sidebarMouseLeave = () => {
    if (! isPinnedSidebar.value) {
        store.dispatch('layout/setSidebarType', 'mini')
    }
}
</script>
