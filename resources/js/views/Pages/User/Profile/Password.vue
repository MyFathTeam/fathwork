<template>
    <ParentTransition appear :visibility="true">
        <FormAction
            no-card
            :init-url="initUrl"
            :init-form="initForm"
            :form="form"
            action="changePassword"
            stay-on
            redirect="Dashboard"
        >
            <template #title>
                {{$trans('auth.password.change_password')}}
            </template>
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="password"
                        leading-icon="fas fa-key"
                        v-model="form.currentPassword"
                        name="currentPassword"
                        :label="
                            $trans('auth.password.props.current_password')
                        "
                        v-model:error="formErrors.currentPassword"
                        autofocus
                    />
                </div>

                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="password"
                        leading-icon="fas fa-key"
                        v-model="form.newPassword"
                        name="newPassword"
                        :label="$trans('auth.password.props.new_password')"
                        v-model:error="formErrors.newPassword"
                    />
                </div>

                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="password"
                        leading-icon="fas fa-key"
                        v-model="form.newPasswordConfirmation"
                        name="newPasswordConfirmation"
                        :label="$trans('auth.password.props.new_password_confirmation')"
                        v-model:error="formErrors.newPasswordConfirmation"
                    />
                </div>
            </div>
        </FormAction>
    </ParentTransition>
</template>

<script>
export default {
    name: "UserPassword",
};
</script>

<script setup>
import { reactive } from "vue";
import { getFormErrors } from "@core/helpers/action"

const initUrl = "user/profile/"
const formErrors = getFormErrors(initUrl);

const initForm = {
    currentPassword: "",
    newPassword: "",
    newPasswordConfirmation: "",
};

const form = reactive({ ...initForm });
</script>
