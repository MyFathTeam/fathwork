<template>
    <ConfigPage>
        <FormAction
            no-card
            :init-url="initUrl"
            data-fetch="general"
            :init-form="initForm"
            :form="form"
            action="store"
            stay-on
            redirect="Dashboard"
        >
            <CardHeader
                first
                :title="$trans('config.general.general_config')"
                :description="$trans('config.general.general_info')"
            ></CardHeader>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appName"
                        name="appName"
                        :label="$trans('config.general.props.app_name')"
                        v-model:error="formErrors.appName"
                    />
                </div>
                <div class="col-span-3 sm:col-span-2">
                    <BaseInput
                        type="text"
                        v-model="form.appDescription"
                        name="appDescription"
                        :label="$trans('config.general.props.app_description')"
                        v-model:error="formErrors.appDescription"
                    />
                </div>
            </div>
            <CardHeader
                :title="$trans('config.general.address')"
                :description="$trans('config.general.address_info')"
            ></CardHeader>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appAddressLine1"
                        name="appAddressLine1"
                        :label="$trans('config.general.props.app_address_line1')"
                        v-model:error="formErrors.appAddressLine1"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appAddressLine"
                        name="appAddressLine"
                        :label="$trans('config.general.props.app_address_line2')"
                        v-model:error="formErrors.appAddressLine"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appCity"
                        name="appCity"
                        :label="$trans('config.general.props.app_city')"
                        v-model:error="formErrors.appCity"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appState"
                        name="appState"
                        :label="$trans('config.general.props.app_state')"
                        v-model:error="formErrors.appState"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appZipcode"
                        name="appZipcode"
                        :label="$trans('config.general.props.app_zipcode')"
                        v-model:error="formErrors.appZipcode"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appCountry"
                        name="appCountry"
                        :label="$trans('config.general.props.app_country')"
                        v-model:error="formErrors.appCountry"
                    />
                </div>
            </div>
            <CardHeader
                :title="$trans('config.general.contact')"
                :description="$trans('config.general.contact_info')"
            ></CardHeader>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appEmail"
                        name="appEmail"
                        :label="$trans('config.general.props.app_email')"
                        v-model:error="formErrors.appEmail"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appPhone"
                        name="appPhone"
                        :label="$trans('config.general.props.app_phone')"
                        v-model:error="formErrors.appPhone"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appFax"
                        name="appFax"
                        :label="$trans('config.general.props.app_fax')"
                        v-model:error="formErrors.appFax"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.appWebsite"
                        name="appWebsite"
                        :label="$trans('config.general.props.app_website')"
                        v-model:error="formErrors.appWebsite"
                    />
                </div>
            </div>
        </FormAction>
    </ConfigPage>
</template>

<script>
export default {
    name: "ConfigGeneral",
};
</script>

<script setup>
import { reactive } from "vue"
import { getFormErrors } from "@core/helpers/action"

const initUrl = "config/"
const formErrors = getFormErrors(initUrl);

const initForm = {
    appName: "",
    appDescription: "",
    appEmail: "",
    appPhone: "",
    appFax: "",
    appWebsite: "",
    appAddressLine1: "",
    appAddressLine2: "",
    appCity: "",
    appState: "",
    appZipcode: "",
    appCountry: "",
    type: "general",
};

const form = reactive({ ...initForm })
</script>
