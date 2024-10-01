<template>
    <ParentTransition appear :visibility="true">
        <FormAction
            no-card
            :init-url="initUrl"
            action="updateProfile"
            :init-form="initForm"
            :form="form"
            stay-on
            redirect="Dashboard"
        >
            <template #title>
                {{$trans('user.profile.profile')}}
            </template>
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.name"
                        name="name"
                        :label="
                            $trans('user.profile.props.name')
                        "
                        v-model:error="formErrors.name"
                        autofocus
                    />
                </div>
            </div>
        </FormAction>
    </ParentTransition>
</template>

<script>
export default {
    name: 'UserProfile'
}
</script>

<script setup>
import { reactive } from "vue";
import { getFormErrors, getAuthUser } from "@core/helpers/action"

const initUrl = "user/profile/"
const formErrors = getFormErrors(initUrl);
const profile = getAuthUser('profile');

const initForm = {
    name: profile.value.name,
};

const form = reactive({ ...initForm })
</script>