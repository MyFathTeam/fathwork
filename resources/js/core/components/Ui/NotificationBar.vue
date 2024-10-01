<template>
    <div class="sticky top-0 bg-black border-b border-b-gray-900 text-gray-300 py-2 px-6" v-if="hasNotificationBar">
        <Vue3Marquee><div class="px-4" v-html="getNotificationMessage"></div></Vue3Marquee>
    </div>
</template>

<script>
export default {
    name: 'NotificationBar'
}
</script>

<script setup>
import { ref } from "vue"
import { getConfig } from "@core/helpers/action"

const props = defineProps({
    type: {
        type: String,
        required: true
    }
})

const hasNotificationBar = ref(false)
const getNotificationMessage = ref(null)

if (props.type == 'guest') {
    hasNotificationBar.value = getConfig('notification.enableGuestNotificationBar').value
    getNotificationMessage.value = getConfig('notification.guestNotificationMessage').value
} else if (props.type == 'app') {
    hasNotificationBar.value = getConfig('notification.enableAppNotificationBar').value
    getNotificationMessage.value = getConfig('notification.appNotificationMessage').value
}
</script>
