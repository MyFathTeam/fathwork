<template>
    <ConfigPage>
        <FormAction
            no-card
            :init-url="initUrl"
            :pre-requisites="{data: ['dateFormats','timeFormats','locales','timezones','perPageLengths','currencies']}"
            @setPreRequisites="setPreRequisites"
            data-fetch="system"
            :init-form="initForm"
            :form="form"
            action="store"
            stay-on
            redirect="Config"
        >
            <CardHeader first :title="$trans('config.system.system_config')" :description="$trans('config.system.system_info')"></CardHeader>
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3 sm:col-span-1">
                    <BaseSelect
                        v-model="form.locale"
                        name="locale"
                        :label="
                            $trans('config.system.props.locale')
                        "
                        label-prop="name"
                        value-prop="uuid"
                        :options="preRequisites.locales"
                        v-model:error="formErrors.locale"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSelect
                        v-model="form.timezone"
                        name="timezone"
                        :label="
                            $trans('config.system.props.timezone')
                        "
                        :options="preRequisites.timezones"
                        v-model:error="formErrors.timezone"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSelect
                        v-model="form.dateFormat"
                        name="dateFormat"
                        :label="
                            $trans('config.system.props.date_format')
                        "
                        :options="preRequisites.dateFormats"
                        v-model:error="formErrors.dateFormat"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSelect
                        v-model="form.timeFormat"
                        name="timeFormat"
                        :label="
                            $trans('config.system.props.time_format')
                        "
                        :options="preRequisites.timeFormats"
                        v-model:error="formErrors.timeFormat"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSelect
                        v-model="form.perPage"
                        name="perPage"
                        :label="
                            $trans('config.system.props.per_page_length')
                        "
                        :options="preRequisites.perPageLengths"
                        v-model:error="formErrors.perPage"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSelect
                        multiple
                        v-model="form.currencies"
                        name="currencies"
                        :label="
                            $trans('config.system.props.allowed_currency')
                        "
                        :options="preRequisites.currencies"
                        v-model:error="formErrors.currencies"
                    >
                        <template #selectedOption="slotProps">
                            {{slotProps.value.description}} ({{slotProps.value.symbol}})
                        </template>

                        <template #listOption="slotProps">
                            {{slotProps.option.description}} ({{slotProps.option.symbol}})
                        </template>
                    </BaseSelect>
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSelect
                        v-model="form.currency"
                        name="currency"
                        :label="
                            $trans('config.system.props.default_currency')
                        "
                        :options="preRequisites.currencies"
                        v-model:error="formErrors.currency"
                    >
                        <template #selectedOption="slotProps">
                            {{slotProps.value.description}} ({{slotProps.value.symbol}})
                        </template>

                        <template #listOption="slotProps">
                            {{slotProps.option.description}} ({{slotProps.option.symbol}})
                        </template>
                    </BaseSelect>
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        v-model="form.enableDarkTheme"
                        name="enableDarkTheme"
                        :label="$trans('global.enable', {attribute: $trans('config.system.props.dark_theme')})"
                        v-model:error="formErrors.enableDarkTheme"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        v-model="form.enableMiniSidebar"
                        name="enableMiniSidebar"
                        :label="$trans('global.enable', {attribute: $trans('config.system.props.mini_sidebar')})"
                        v-model:error="formErrors.enableMiniSidebar"
                    />
                </div>
            </div>

            <CardHeader :title="$trans('config.system.credit')" :description="$trans('config.system.credit_info')"></CardHeader>
            <div class="grid grid-cols-3">
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        v-model="form.showVersionNumber"
                        name="showVersionNumber"
                        :label="$trans('config.system.props.show_version_number')"
                        v-model:error="formErrors.showVersionNumber"
                    />
                </div>
            </div>
            <div class="mt-6 grid grid-cols-1">
                <div class="sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.footerCredit"
                        name="appName"
                        :label="
                            $trans('config.system.props.footer_credit')
                        "
                        v-model:error="formErrors.footerCredit"
                    />
                </div>
            </div>

            <CardHeader :title="$trans('config.system.maintenance_mode')" :description="$trans('config.system.maintenance_mode_info')"></CardHeader>
            <div class="grid grid-cols-3">
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        v-model="form.enableMaintenanceMode"
                        name="enableMaintenanceMode"
                        :label="$trans('config.system.props.maintenance_mode')"
                        v-model:error="formErrors.enableMaintenanceMode"
                    />
                </div>
            </div>
            <div class="mt-6 grid grid-cols-1" v-if="form.enableMaintenanceMode">
                <div class="sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.maintenanceModeMessage"
                        name="appName"
                        :label="
                            $trans('config.system.props.maintenance_mode_message')
                        "
                        v-model:error="formErrors.maintenanceModeMessage"
                    />
                </div>
            </div>
        </FormAction>
    </ConfigPage>
</template>

<script>
export default {
    name: 'ConfigSystem'
}
</script>

<script setup>
import { reactive } from "vue"
import { getFormErrors } from "@core/helpers/action"

const initUrl = "config/"
const formErrors = getFormErrors(initUrl);

const preRequisites = reactive({})
const initForm = {
    dateFormat: '',
    timeFormat: '',
    locale: '',
    timezone: '',
    enableDarkTheme: false,
    enableMiniSidebar: false,
    perPage: '',
    currency: '',
    currencies: [],
    showVersionNumber: false,
    footerCredit: '',
    enableMaintenanceMode: false,
    maintenanceModeMessage: '',
    type: 'system'
}

const form = reactive({ ...initForm })

const setPreRequisites = (data) => {
    Object.assign(preRequisites, data)
}
</script>
