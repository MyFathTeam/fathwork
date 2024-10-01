<template>
    <GuestHeader :label="$trans('auth.login.login_title')"></GuestHeader>

    <ParentTransition appear :visibility="true">
        <FormAction
            no-card
            no-action-button
            :init-url="initUrl"
            :init-form="initForm"
            :form="form"
            action="login"
            :after-submit="afterSubmit"
        >
            <div class="space-y-6">
                <BaseInput
                    type="text"
                    leading-icon="fas fa-envelope"
                    v-model="form.email"
                    name="email"
                    :label="$trans('auth.login.props.email_or_username')"
                    v-model:error="formErrors.email"
                    autofocus
                />

                <BaseInput
                    type="password"
                    leading-icon="fas fa-key"
                    v-model="form.password"
                    name="password"
                    :label="$trans('auth.login.props.password')"
                    v-model:error="formErrors.password"
                />

                <div class="flex items-center justify-between">
                    <BaseCheckbox v-model="form.rememberMe" name="rememberMe" :label="$trans('auth.login.props.remember_me')"></BaseCheckbox>

                    <BaseLink to="Password" v-if="hasResetPasswordEnabled">{{$trans('auth.password.forgot_password')}}</BaseLink>
                </div>

                <div class="flex justify-center space-x-2" v-if="hasOAuthLoginEnabled">
                    <BaseButton as="a" href="/auth/google/redirect" design="danger" size="xs" v-tooltip="$trans('config.auth.props.login_with_client', {attribute: 'Google'})" v-if="hasGoogleOauthLogin"><i class="fab fa-google"></i></BaseButton>

                    <BaseButton as="a" href="/auth/facebook/redirect" design="facebook" size="xs" v-tooltip="$trans('config.auth.props.login_with_client', {attribute: 'Facebook'})" v-if="hasFacebookOauthLogin"><i class="fab fa-facebook"></i></BaseButton>

                    <BaseButton as="a" href="/auth/twitter/redirect" design="info" size="xs" v-tooltip="$trans('config.auth.props.login_with_client', {attribute: 'Twitter'})" v-if="hasTwitterOauthLogin"><i class="fab fa-twitter"></i></BaseButton>

                    <BaseButton as="a" href="/auth/github/redirect" size="xs" v-tooltip="$trans('config.auth.props.login_with_client', {attribute: 'Github'})" v-if="hasGithubOauthLogin"><i class="fab fa-github"></i></BaseButton>
                </div>

                <div class="flex items-center justify-center" v-if="hasRegistrationEnabled">
                    <BaseLink to="Register">{{$trans('auth.register.register_title')}}</BaseLink>
                </div>

                <BaseButton type="submit" block>{{$trans('auth.login.login')}}</BaseButton>
            </div>
        </FormAction>
    </ParentTransition>
</template>

<script setup>
import { reactive, onMounted } from 'vue'
import { useStore } from 'vuex'
import { useRoute, useRouter } from 'vue-router'
import { getFormErrors, getConfig } from "@core/helpers/action"

const route = useRoute()
const router = useRouter()
const store = useStore()

const initUrl = "auth/user/"
const formErrors = getFormErrors(initUrl)
const hasOAuthLoginEnabled = getConfig('auth.enableOauthLogin')
const hasRegistrationEnabled = getConfig('auth.enableRegistration')
const hasResetPasswordEnabled = getConfig('auth.enableResetPassword')
const hasGoogleOauthLogin = getConfig('auth.enableGoogleOauthLogin')
const hasFacebookOauthLogin = getConfig('auth.enableFacebookOauthLogin')
const hasTwitterOauthLogin = getConfig('auth.enableTwitterOauthLogin')
const hasGithubOauthLogin = getConfig('auth.enableGithubOauthLogin')

const initForm = {
    email: '',
    password: '',
    rememberMe: false
}

const form = reactive({ ...initForm })

onMounted(async () => {
    await store.dispatch('auth/user/setCSRF')
})

const afterSubmit = () => {
    Object.assign(form, initForm);
    router.push(route.query.ref ? route.query.ref : {name: 'Dashboard'})
}
</script>
