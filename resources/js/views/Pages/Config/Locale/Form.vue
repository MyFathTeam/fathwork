<template>
    <FormAction
        :init-url="initUrl"
        :init-form="initForm"
        :form="form"
        redirect="ConfigLocale"
    >
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-3 sm:col-span-1">
                <BaseInput
                    type="text"
                    v-model="form.name"
                    name="name"
                    :label="
                        $trans('config.locale.props.name')
                    "
                    v-model:error="formErrors.name"
                    autofocus
                />
            </div>
            <div class="col-span-3 sm:col-span-1">
                <BaseInput
                    :disabled="route.meta.type === 'edit'"
                    type="text"
                    v-model="form.code"
                    name="code"
                    :label="
                        $trans('config.locale.props.code')
                    "
                    v-model:error="formErrors.code"
                    autofocus
                />
            </div>
        </div>
    </FormAction>
</template>

<script>
export default {
    name: 'LocaleForm'
}
</script>

<script setup>
import { reactive } from "vue";
import { useRoute } from "vue-router";
import { getFormErrors } from "@core/helpers/action"

const route = useRoute();

const initForm = {
    name: "",
    code: ""
};

const initUrl = "config/locale/"
const formErrors = getFormErrors(initUrl);

const form = reactive({ ...initForm });
</script>
