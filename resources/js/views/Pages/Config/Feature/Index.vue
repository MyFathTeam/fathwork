<template>
    <ConfigPage>
        <FormAction
            no-card
            :init-url="initUrl"
            data-fetch="feature"
            :init-form="initForm"
            :form="form"
            action="store"
            stay-on
            redirect="Config"
        >
            <CardHeader first :title="$trans('config.feature.feature_config')" :description="$trans('config.feature.feature_info')"></CardHeader>
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        v-model="form.enableTodo"
                        name="enableTodo"
                        :label="$trans('config.feature.props.todo')"
                        v-model:error="formErrors.enableTodo"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        v-model="form.enableBackup"
                        name="enableBackup"
                        :label="$trans('config.feature.props.backup')"
                        v-model:error="formErrors.enableBackup"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        v-model="form.enableActivityLog"
                        name="enableActivityLog"
                        :label="$trans('config.feature.props.activity_log')"
                        v-model:error="formErrors.enableActivityLog"
                    />
                </div>
            </div>
        </FormAction>
    </ConfigPage>
</template>

<script>
export default {
    name: 'ConfigFeature'
}
</script>

<script setup>
import { reactive } from "vue"
import { getFormErrors } from "@core/helpers/action"

const initUrl = "config/"
const formErrors = getFormErrors(initUrl);

const initForm = {
    enableTodo: false,
    enableBackup: false,
    enableActivityLog: false,
    type: 'feature'
}

const form = reactive({ ...initForm })
</script>