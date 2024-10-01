<template>
    <ConfigPage>
        <template #action>
            <BaseButton design="primary" v-if="form.enablePusherNotification" @click="testPusherConnection">{{$trans('config.notification.test_pusher_connection')}}</BaseButton>
        </template>
        <FormAction
            no-card
            :init-url="initUrl"
            data-fetch="notification"
            :init-form="initForm"
            :form="form"
            action="store"
            stay-on
            redirect="Config"
        >
            <CardHeader first :title="$trans('config.notification.notification_config')" :description="$trans('config.notification.notification_info')"></CardHeader>
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        reverse
                        v-model="form.enableGuestNotificationBar"
                        name="enableGuestNotificationBar"
                        :label="$trans('config.notification.props.enable_guest_notification_bar')"
                        v-model:error="formErrors.enableGuestNotificationBar"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        reverse
                        v-model="form.enableAppNotificationBar"
                        name="enableAppNotificationBar"
                        :label="$trans('config.notification.props.enable_app_notification_bar')"
                        v-model:error="formErrors.enableAppNotificationBar"
                    />
                </div>
                <div class="col-span-3" v-if="form.enableGuestNotificationBar">
                    <BaseTextarea
                        :rows="2"
                        v-model="form.guestNotificationMessage"
                        name="guestNotificationMessage"
                        :placeholder="
                            $trans('config.notification.props.guest_notification_message')
                        "
                        v-model:error="formErrors.guestNotificationMessage"
                    />
                </div>
                <div class="col-span-3" v-if="form.enableAppNotificationBar">
                    <BaseTextarea
                        :rows="2"
                        v-model="form.appNotificationMessage"
                        name="appNotificationMessage"
                        :placeholder="
                            $trans('config.notification.props.app_notification_message')
                        "
                        v-model:error="formErrors.appNotificationMessage"
                    />
                </div>
            </div>
            <div class="mt-4 grid grid-cols-3 gap-6">
                <div class="col-span-3">
                    <BaseSwitch
                        reverse
                        v-model="form.enablePusherNotification"
                        name="enablePusherNotification"
                        :label="$trans('config.notification.props.enable_pusher_notification')"
                        v-model:error="formErrors.enablePusherNotification"
                    />
                </div>
                <template v-if="form.enablePusherNotification">
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.pusherAppId"
                            name="pusherAppId"
                            :label="$trans('config.notification.props.pusher_app_id')"
                            v-model:error="formErrors.pusherAppId"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.pusherAppKey"
                            name="pusherAppKey"
                            :label="$trans('config.notification.props.pusher_app_key')"
                            v-model:error="formErrors.pusherAppKey"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.pusherAppSecret"
                            name="pusherAppSecret"
                            :label="$trans('config.notification.props.pusher_app_secret')"
                            v-model:error="formErrors.pusherAppSecret"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.pusherAppCluster"
                            name="pusherAppCluster"
                            :label="$trans('config.notification.props.pusher_app_cluster')"
                            v-model:error="formErrors.pusherAppCluster"
                        />
                    </div>
                </template>
            </div>
        </FormAction>
    </ConfigPage>
</template>

<script>
export default {
    name: 'ConfigNotification'
}
</script>

<script setup>
import { reactive } from "vue"
import { useStore } from "vuex"
import { getFormErrors } from "@core/helpers/action"

const store = useStore()

const initUrl = "config/"
const formErrors = getFormErrors(initUrl);

const initForm = {
    enableGuestNotificationBar: false,
    enableAppNotificationBar: false,
    guestNotificationMessage: '',
    appNotificationMessage: '',
    enablePusherNotification: false,
    pusherAppId: '',
    pusherAppKey: '',
    pusherAppSecret: '',
    pusherAppCluster: '',
    type: 'notification'
}

const form = reactive({ ...initForm })

const testPusherConnection = () => {
    store.dispatch('config/testPusherConnection').catch(e => {})
}
</script>
