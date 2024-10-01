<template>
    <GuestHeader :label="$trans('auth.register.register_title')"></GuestHeader>

    <ParentTransition appear :visibility="true">
        <FormAction
            no-card
            no-action-button
            :init-url="initUrl"
            :init-form="initForm"
            :form="form"
            action="register"
            redirect="Login"
        >
            <div class="space-y-6">
                <BaseInput
                    type="text"
                    v-model="form.name"
                    name="name"
                    :label="$trans('auth.register.props.name')"
                    v-model:error="formErrors.name"
                    autofocus
                />

                <BaseInput
                    type="text"
                    v-model="form.email"
                    name="email"
                    :label="$trans('auth.register.props.email')"
                    v-model:error="formErrors.email"
                />

                <BaseInput
                    type="text"
                    v-model="form.username"
                    name="username"
                    :label="$trans('auth.register.props.username')"
                    v-model:error="formErrors.username"
                />

                <BaseInput
                    type="password"
                    v-model="form.password"
                    name="password"
                    :label="$trans('auth.register.props.password')"
                    v-model:error="formErrors.password"
                />

                <BaseInput
                    type="password"
                    v-model="form.passwordConfirmation"
                    name="passwordConfirmation"
                    :label="$trans('auth.register.props.password_confirmation')"
                    v-model:error="formErrors.passwordConfirmation"
                />

                <div class="flex items-center justify-center">
                    <BaseLink to="Login">{{$trans('auth.login.login_title')}}</BaseLink>
                </div>

                <BaseButton type="submit" block>{{$trans('auth.register.register')}}</BaseButton>

                <div class="flex items-center justify-center" v-if="hasEmailVerificationEnabled">
                    <BaseLink to="EmailRequest">{{$trans('auth.register.email_request_description')}}</BaseLink>
                </div>
            </div>
        </FormAction>
    </ParentTransition>
</template>

<script setup>
import { reactive } from 'vue'
import { getFormErrors, getConfig } from "@core/helpers/action"

const initUrl = "auth/register/"
const formErrors = getFormErrors(initUrl)
const hasEmailVerificationEnabled = getConfig('auth.enableEmailVerification')

const initForm = {
    name: '',
    email: '',
    username: '',
    password: '',
    passwordConfirmation: ''
}

const form = reactive({ ...initForm })
</script>
