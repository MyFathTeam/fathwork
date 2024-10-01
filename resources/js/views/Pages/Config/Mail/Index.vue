<template>
    <ConfigPage>
        <template #action>
            <BaseButton design="primary" @click="testConnection">{{$trans('config.mail.test_connection')}}</BaseButton>
        </template>
        <FormAction
            no-card
            :init-url="initUrl"
            :pre-requisites="{data: ['mailDrivers']}"
            @setPreRequisites="setPreRequisites"
            data-fetch="mail"
            :init-form="initForm"
            :form="form"
            action="store"
            stay-on
            redirect="Config"
        >
            <CardHeader first :title="$trans('config.mail.mail_config')" :description="$trans('config.mail.mail_info')"></CardHeader>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3 sm:col-span-1">
                    <BaseSelect
                        v-model="form.driver"
                        name="driver"
                        :label="
                            $trans('config.mail.props.driver')
                        "
                        :options="preRequisites.mailDrivers"
                        v-model:error="formErrors.driver"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.fromName"
                        name="fromName"
                        :label="
                            $trans('config.mail.props.from_name')
                        "
                        v-model:error="formErrors.fromName"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.fromAddress"
                        name="fromAddress"
                        :label="
                            $trans('config.mail.props.from_address')
                        "
                        v-model:error="formErrors.fromAddress"
                    />
                </div>
            </div>
            <template v-if="form.driver == 'smtp'">
                <CardHeader :title="$trans('config.mail.smtp')"></CardHeader>
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.smtpHost"
                            name="smtpHost"
                            :label="
                                $trans('config.mail.props.smtp_host')
                            "
                            v-model:error="formErrors.smtpHost"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.smtpPort"
                            name="smtpPort"
                            :label="
                                $trans('config.mail.props.smtp_port')
                            "
                            v-model:error="formErrors.smtpPort"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.smtpEncryption"
                            name="smtpEncryption"
                            :label="
                                $trans('config.mail.props.smtp_encryption')
                            "
                            v-model:error="formErrors.smtpEncryption"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.smtpUsername"
                            name="smtpUsername"
                            :label="
                                $trans('config.mail.props.smtp_username')
                            "
                            v-model:error="formErrors.smtpUsername"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="password"
                            v-model="form.smtpPassword"
                            name="smtpPassword"
                            :label="
                                $trans('config.mail.props.smtp_password')
                            "
                            v-model:error="formErrors.smtpPassword"
                        />
                    </div>
                </div>
            </template>
            <template v-if="form.driver == 'mailgun'">
                <CardHeader :title="$trans('config.mail.mailgun')"></CardHeader>
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.mailgunDomain"
                            name="mailgunDomain"
                            :label="
                                $trans('config.mail.props.mailgun_domain')
                            "
                            v-model:error="formErrors.mailgunDomain"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.mailgunSecret"
                            name="mailgunSecret"
                            :label="
                                $trans('config.mail.props.mailgun_secret')
                            "
                            v-model:error="formErrors.mailgunSecret"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseInput
                            type="text"
                            v-model="form.mailgunEndpoint"
                            name="mailgunEndpoint"
                            :label="
                                $trans('config.mail.props.mailgun_endpoint')
                            "
                            v-model:error="formErrors.mailgunEndpoint"
                        />
                    </div>
                </div>
            </template>
        </FormAction>
    </ConfigPage>
</template>

<script>
export default {
    name: 'ConfigMail'
}
</script>

<script setup>
import { reactive } from "vue"
import { useStore } from "vuex"
import { getFormErrors } from "@core/helpers/action"

const store = useStore()

const initUrl = "config/"
const formErrors = getFormErrors(initUrl);

const preRequisites = reactive({})
const initForm = {
    driver: '',
    fromName: '',
    fromAddress: '',
    smtpHost: '',
    smtpPort: '',
    smtpUsername: '',
    smtpPassword: '',
    smtpEncryption: '',
    mailgunDomain: '',
    mailgunSecret: '',
    mailgunEndpoint: '',
    type: 'mail'
}

const form = reactive({ ...initForm })

const setPreRequisites = (data) => {
    Object.assign(preRequisites, data)
}

const testConnection = () => {
    store.dispatch('config/testMailConnection').catch(e => {})
}
</script>
