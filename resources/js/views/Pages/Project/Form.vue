<template>
    <FormAction
        :init-url="initUrl"
        :init-form="initForm"
        :form="form"
        redirect="Project"
    >
        <div class="grid grid-cols-2 gap-6">
            <div class="col-span-2">
                <BaseInput
                    type="text"
                    v-model="form.title"
                    name="title"
                    :label="
                        $trans('project.props.title')
                    "
                    v-model:error="formErrors.title"
                    autofocus
                />
            </div>
            <div class="col-span-3 sm:col-span-2">
                <BaseTextarea
                    v-model="form.description"
                    name="description"
                    :label="
                        $trans('project.props.description')
                    "
                    v-model:error="formErrors.description"
                />
            </div>
        </div>
        <div class="grid grid-cols-1">
            <div class="col">
                <MediaUpload
                    multiple
                    :label="$trans('general.file')"
                    module="project"
                    :media="form.media"
                    @setHash="hash => form.mediaHash = hash"
                    @setToken="token => form.mediaToken = token"
                    />
            </div>
        </div>
    </FormAction>
</template>

<script>
export default {
    name: 'ProjectForm'
}
</script>

<script setup>
import { reactive } from "vue";
import { getFormErrors } from "@core/helpers/action"

const initForm = {
    title: "",
    description: "",
    media: [],
    mediaToken: "",
    mediaHash: "",
};

const initUrl = "project/"
const formErrors = getFormErrors(initUrl)

const form = reactive({ ...initForm });
</script>
