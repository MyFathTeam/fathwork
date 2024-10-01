<template>
    <NotificationBar type="app" />
    <div class="relative h-screen flex overflow-hidden bg-gray-200 dark:bg-dark-body">
        <AppSidebar></AppSidebar>

        <div class="flex-1 flex flex-col w-0 overflow-hidden"
            :class="{
                'lg:ml-16': ! isPinnedSidebar
            }"
        >
            <AppHeader></AppHeader>

            <main class="flex-1 relative z-0 focus:outline-none scroller-thin-y scroller-hidden" :class="{
                'overflow-y-auto': route.query.view != 'board',
                'overflow-y-hidden': route.query.view == 'board',
            }">
                <div class="space-y-4"
                    :class="{
                        'lg:px-4 py-4': noPadding
                    }"
                >
                    <router-view />
                </div>

                <FooterCredit />
            </main>
        </div>
    </div>

    <ReLogin />
</template>

<script setup>
import { computed } from "vue"
import { useStore } from "vuex"
import { useRoute } from "vue-router"
import { getAuthUser } from "@core/helpers/action"
import { listenPrivate } from "@core/helpers/notification"

import AppSidebar from "@views/Layouts/Partials/AppSidebar.vue";
import AppHeader from "@views/Layouts/Partials/AppHeader.vue";

const store = useStore()
const route = useRoute()

const isPinnedSidebar = computed(() => store.getters['layout/getSidebarType'] === 'pinned' ? true : false)
const noPadding = computed(() => {
    if (route.meta.noPadding) {
        return false
    }

    return true
})

const getAuthUuid = getAuthUser('uuid')
listenPrivate(`users.${getAuthUuid.value}`, 'test.event', (e) => {
    var audio = new Audio('/notification.mp3');
    audio.play();
})
</script>
