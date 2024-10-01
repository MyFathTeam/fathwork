<template>
    <PageHeader
        :title="
            $trans(route.meta.label)
        "
        :navs="[
            { label: $trans('utility.utility'), path: 'Utility' },
        ]"
    >
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <FormAction
            :init-url="initUrl"
            data-fetch="utility"
            action="store"
            :init-form="initForm"
            :form="form"
            stay-on
            redirect="Utility"
        >
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3 sm:col-span-1">
                    <BaseLabel>{{$trans('utility.config.props.todo_view')}}</BaseLabel>
                    <BaseRadioGroup
                        top-margin
                        :options="[
                            {label: $trans('general.views.list'), value: 'list'},
                            {label: $trans('general.views.board'), value: 'board'},
                        ]"
                        name="todoView"
                        v-model="form.todoView"
                        v-model:error="formErrors.todoView"
                        horizontal
                    />
                </div>
            </div>
        </FormAction>
    </ParentTransition>
</template>

<script>
export default {
    name: 'UtilityConfigGeneral'
}
</script>

<script setup>
import { inject, reactive } from "vue"
import { useRoute } from "vue-router"
import { getFormErrors } from "@core/helpers/action"

const route = useRoute()

const $trans = inject("$trans")

const initUrl = "config/"
const formErrors = getFormErrors(initUrl);

const initForm = {
    todoView: "",
    type: "utility",
};

const form = reactive({ ...initForm })
</script>
