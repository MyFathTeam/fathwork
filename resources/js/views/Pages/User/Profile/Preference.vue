<template>
    <ParentTransition appear :visibility="true">
        <FormAction
            no-card
            :init-url="initUrl"
            :pre-requisite-url="preRequisiteUrl"
            :pre-requisites="{data: ['dateFormats','timeFormats','locales','timezones']}"
            @setPreRequisites="setPreRequisites"
            data-fetch="user"
            action="preference"
            :form="form"
            :init-form="initForm"
            :setForm="setForm"
            stay-on
            redirect="Dashboard"
        >
            <template #title>
                {{$trans('user.preference.preference')}}
            </template>
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2 sm:col-span-1">
                    <BaseSelect
                        v-model="form.locale"
                        name="locale"
                        :label="
                            $trans('user.preference.props.locale')
                        "
                        label-prop="name"
                        value-prop="uuid"
                        :options="preRequisites.locales"
                        v-model:error="formErrors.locale"
                    />
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <BaseSelect
                        v-model="form.dateFormat"
                        name="dateFormat"
                        :label="
                            $trans('user.preference.props.date_format')
                        "
                        :options="preRequisites.dateFormats"
                        v-model:error="formErrors.dateFormat"
                    >
                        <template #selectedOption="slotProps">
                            {{getSampleDate(slotProps.value.value)}} <span class="text-xs pl-2"> ({{slotProps.value.label}})</span>
                        </template>

                        <template #listOption="slotProps">
                            {{getSampleDate(slotProps.option.value)}} <span class="text-xs pl-2"> ({{slotProps.option.label}})</span>
                        </template>
                    </BaseSelect>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <BaseSelect
                        v-model="form.timeFormat"
                        name="timeFormat"
                        :label="
                            $trans('user.preference.props.time_format')
                        "
                        :options="preRequisites.timeFormats"
                        v-model:error="formErrors.timeFormat"
                    >
                        <template #selectedOption="slotProps">
                            {{getSampleDate(slotProps.value.value)}} <span class="text-xs pl-2"> ({{slotProps.value.label}})</span>
                        </template>

                        <template #listOption="slotProps">
                            {{getSampleDate(slotProps.option.value)}} <span class="text-xs pl-2"> ({{slotProps.option.label}})</span>
                        </template>
                    </BaseSelect>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <BaseSelect
                        v-model="form.timezone"
                        name="timezone"
                        :label="
                            $trans('user.preference.props.timezone')
                        "
                        :options="preRequisites.timezones"
                        v-model:error="formErrors.timezone"
                    />
                </div>
            </div>
        </FormAction>
    </ParentTransition>
</template>

<script>
export default {
    name: "UserPreference",
};
</script>

<script setup>
import { onMounted, reactive, inject, computed } from "vue"
import { useStore } from "vuex"
import { cloneDeep } from "@core/utils"
import { getFormErrors } from "@core/helpers/action"

const store = useStore()
const moment = inject("moment")

const initUrl = "user/profile/"
const formErrors = getFormErrors(initUrl);
const preference = computed(() => store.getters["auth/user/preference"]);

const preRequisiteUrl = "config/"
const initForm = {
    dateFormat: '',
    timeFormat: '',
    locale: '',
    timezone: '',
}
const preRequisites = reactive({})
const form = reactive({ ...initForm })

const getSampleDate = (format) => {
    return moment().format(format)
}

const setForm = () => {
    Object.assign(initForm, preference.value.system)
    Object.assign(form, cloneDeep(initForm))
}

const setPreRequisites = (data) => {
    Object.assign(preRequisites, data)
}
</script>
