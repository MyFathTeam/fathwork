<template>
    <FormAction
        :init-url="initUrl"
        :init-form="initForm"
        :form="form"
        :set-form="setForm"
        redirect="UtilityTodo"
    >
        <div class="grid grid-cols-2 gap-6">
            <div class="col-span-2">
                <BaseInput
                    type="text"
                    v-model="form.title"
                    name="title"
                    :label="
                        $trans('utility.todo.props.title')
                    "
                    v-model:error="formErrors.title"
                    autofocus
                />
            </div>
            <div class="col-span-2 sm:col-span-1">
                <DatePicker
                    v-model="form.dueDate"
                    name="dueDate"
                    :label="
                        $trans('utility.todo.props.due_date')
                    "
                    no-clear
                    v-model:error="formErrors.dueDate"
                />
            </div>
            <div class="col-span-2 sm:col-span-1">
                <DatePicker
                    v-model="form.dueTime"
                    name="dueTime"
                    :label="
                        $trans('utility.todo.props.due_time')
                    "
                    as="time"
                    v-model:error="formErrors.dueTime"
                />
            </div>
            <div class="col-span-2">
                <BaseEditor
                    id="Testing"
                    v-model="form.description"
                    name="description"
                    :edit="route.params.uuid ? true : false"
                    :label="$trans('utility.todo.props.description')"
                    v-model:error="formErrors.description"
                />
            </div>
        </div>
    </FormAction>
</template>

<script>
export default {
    name: 'TodoForm'
}
</script>

<script setup>
import { reactive } from "vue";
import { useRoute } from "vue-router";
import { cloneDeep } from "@core/utils"
import { getFormErrors } from "@core/helpers/action"

const route = useRoute()

const initForm = {
    title: "",
    dueDate: null,
    dueTime: null,
    description: ""
};

const initUrl = "utility/todo/"
const formErrors = getFormErrors(initUrl)

const form = reactive({ ...initForm });

const setForm = (data) => {
    Object.assign(initForm, {
        ...data,
        dueDate: data.dueDate.value,
        dueTime: data.dueTime?.at,
    });
    Object.assign(form, cloneDeep(initForm));
}
</script>
