<template>
    <GuestHeader :label="$trans('auth.register.email_request')"></GuestHeader>

    <ParentTransition appear :visibility="true">
        <FormAction
            no-card
            no-action-button
            :init-url="initUrl"
            :init-form="initForm"
            :form="form"
            action="emailRequest"
            redirect="Login"
        >
            <div class="space-y-6">
                <BaseInput
                    type="text"
                    leading-icon="fas fa-envelope"
                    v-model="form.email"
                    name="email"
                    :label="$trans('auth.register.props.email')"
                    v-model:error="formErrors.email"
                    autofocus
                />

                <div class="flex items-center justify-between">
                    <BaseLink to="Login">{{$trans('auth.login.login_title')}}</BaseLink>
                </div>

                <BaseButton type="submit" block>{{$trans('auth.register.email_request')}}</BaseButton>
            </div>
        </FormAction>
    </ParentTransition>
</template>

<script setup>
import { reactive } from 'vue'
import { getFormErrors } from "@core/helpers/action"

const initUrl = "auth/register/"
const formErrors = getFormErrors(initUrl)

const initForm = {
    email: ''
}

const form = reactive({ ...initForm })
</script>
