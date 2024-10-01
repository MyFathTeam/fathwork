<template>
    <FormAction
        :pre-requisites="{data: route.meta.queryType}"
        @setPreRequisites="setPreRequisites"
        :init-url="initUrl"
        :init-form="initForm"
        :form="form"
        :redirect="route.meta.prefix"
    >
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-3 sm:col-span-1">
                <BaseInput
                    type="text"
                    v-model="form.name"
                    name="name"
                    :label="
                        $trans(`${route.meta.transKey}.props.name`)
                    "
                    v-model:error="formErrors.name"
                    autofocus
                />
            </div>
            <div class="col-span-3 sm:col-span-2 flex items-end">
                <SelectedColorPicker v-model="form.color" :label="$trans('general.color')" v-model:error="formErrors.color" />
            </div>
            <div class="col-span-3">
                <BaseTextarea
                    v-model="form.description"
                    name="description"
                    :label="
                        $trans(`${route.meta.transKey}.props.description`)
                    "
                    v-model:error="formErrors.description"
                />
            </div>
        </div>
    </FormAction>
</template>

<script>
export default {
    name: 'OptionForm'
}
</script>

<script setup>
import { reactive } from "vue";
import { useRoute } from "vue-router"
import { getFormErrors } from "@core/helpers/action"

const route = useRoute()

const initForm = {
    name: "",
    color: "",
    description: ""
};

const initUrl = "option/"
const preRequisites = reactive({
    colors: []
})
const formErrors = getFormErrors(initUrl)

const form = reactive({ ...initForm });

const setPreRequisites = (data) => {
    Object.assign(preRequisites, data)
}
</script>
