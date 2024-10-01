<template>
    <ConfigPage>
        <FormAction
            no-card
            :init-url="initUrl"
            data-fetch="auth"
            :init-form="initForm"
            :form="form"
            action="store"
            stay-on
            redirect="Config"
        >
            <CardHeader first :title="$trans('config.auth.auth_config')" :description="$trans('config.auth.auth_info')"></CardHeader>
            <div class="grid grid-cols-3 gap-6">
                <!-- <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.sessionLifetime"
                        name="sessionLifetime"
                        :label="$trans('config.auth.props.session_lifetime')"
                        :label-hint="$trans('config.auth.session_lifetime_hint')"
                        v-model:error="formErrors.sessionLifetime"
                    />
                </div> -->
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.loginThrottleMaxAttempts"
                        name="loginThrottleMaxAttempts"
                        :label="$trans('config.auth.props.login_throttle_max_attempts')"
                        v-model:error="formErrors.loginThrottleMaxAttempts"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        type="text"
                        v-model="form.loginThrottleLockTimeout"
                        name="loginThrottleLockTimeout"
                        :label="$trans('config.auth.props.login_throttle_lock_timeout')"
                        v-model:error="formErrors.loginThrottleLockTimeout"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1" v-if="form.enableResetPassword">
                    <BaseInput
                        type="text"
                        v-model="form.resetPasswordTokenLifetime"
                        name="resetPasswordTokenLifetime"
                        :label="$trans('config.auth.props.reset_password_token_lifetime')"
                        v-model:error="formErrors.resetPasswordTokenLifetime"
                    />
                </div>
            </div>
            <div class="mt-4 grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        v-model="form.enableResetPassword"
                        name="enableResetPassword"
                        :label="$trans('config.auth.props.enable_reset_password')"
                        v-model:error="formErrors.enableResetPassword"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        v-model="form.enableRegistration"
                        name="enableRegistration"
                        :label="$trans('config.auth.props.enable_registration')"
                        v-model:error="formErrors.enableRegistration"
                    />
                </div>
                <template v-if="form.enableRegistration">
                    <div class="col-span-3 sm:col-span-1">
                        <BaseSwitch
                            v-model="form.enableRegistrationTerms"
                            name="enableRegistrationTerms"
                            :label="$trans('config.auth.props.enable_registration_terms')"
                            v-model:error="formErrors.enableRegistrationTerms"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseSwitch
                            v-model="form.enableEmailVerification"
                            name="enableEmailVerification"
                            :label="$trans('config.auth.props.enable_email_verification')"
                            v-model:error="formErrors.enableEmailVerification"
                        />
                    </div>
                    <div class="col-span-3 sm:col-span-1">
                        <BaseSwitch
                            v-model="form.enableAccountApproval"
                            name="enableAccountApproval"
                            :label="$trans('config.auth.props.enable_account_approval')"
                            v-model:error="formErrors.enableAccountApproval"
                        />
                    </div>
                </template>
                <div class="col-span-3 sm:col-span-1">
                    <BaseSwitch
                        v-model="form.enableOauthLogin"
                        name="enableOauthLogin"
                        :label="$trans('config.auth.props.enable_oauth_login')"
                        v-model:error="formErrors.enableOauthLogin"
                    />
                </div>
                <template v-if="form.enableOauthLogin">
                    <div class="col-span-3">
                        <BaseSwitch
                            v-model="form.enableGoogleOauthLogin"
                            name="enableGoogleOauthLogin"
                            :label="$trans('config.auth.props.enable_oauth', {attribute: 'Google'})"
                            v-model:error="formErrors.enableGoogleOauthLogin"
                        />
                    </div>
                    <template v-if="form.enableGoogleOauthLogin">
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.googleClientId"
                                name="googleClientId"
                                :label="$trans('config.auth.props.client_id', {attribute: 'Google'})"
                                v-model:error="formErrors.googleClientId"
                            />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.googleClientSecret"
                                name="googleClientSecret"
                                :label="$trans('config.auth.props.client_secret', {attribute: 'Google'})"
                                v-model:error="formErrors.googleClientSecret"
                            />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.googleCallbackUrl"
                                name="googleCallbackUrl"
                                :label="$trans('config.auth.props.callback_url', {attribute: 'Google'})"
                                v-model:error="formErrors.googleCallbackUrl"
                            />
                        </div>
                    </template>
                    <div class="col-span-3">
                        <BaseSwitch
                            v-model="form.enableFacebookOauthLogin"
                            name="enableFacebookOauthLogin"
                            :label="$trans('config.auth.props.enable_oauth', {attribute: 'Facebook'})"
                            v-model:error="formErrors.enableFacebookOauthLogin"
                        />
                    </div>
                    <template v-if="form.enableFacebookOauthLogin">
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.facebookClientId"
                                name="facebookClientId"
                                :label="$trans('config.auth.props.client_id', {attribute: 'Facebook'})"
                                v-model:error="formErrors.facebookClientId"
                            />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.facebookClientSecret"
                                name="facebookClientSecret"
                                :label="$trans('config.auth.props.client_secret', {attribute: 'Facebook'})"
                                v-model:error="formErrors.facebookClientSecret"
                            />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.facebookCallbackUrl"
                                name="facebookCallbackUrl"
                                :label="$trans('config.auth.props.callback_url', {attribute: 'Facebook'})"
                                v-model:error="formErrors.facebookCallbackUrl"
                            />
                        </div>
                    </template>
                    <div class="col-span-3">
                        <BaseSwitch
                            v-model="form.enableTwitterOauthLogin"
                            name="enableTwitterOauthLogin"
                            :label="$trans('config.auth.props.enable_oauth', {attribute: 'Twitter'})"
                            v-model:error="formErrors.enableTwitterOauthLogin"
                        />
                    </div>
                    <template v-if="form.enableTwitterOauthLogin">
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.twitterClientId"
                                name="twitterClientId"
                                :label="$trans('config.auth.props.client_id', {attribute: 'Twitter'})"
                                v-model:error="formErrors.twitterClientId"
                            />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.twitterClientSecret"
                                name="twitterClientSecret"
                                :label="$trans('config.auth.props.client_secret', {attribute: 'Twitter'})"
                                v-model:error="formErrors.twitterClientSecret"
                            />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.twitterCallbackUrl"
                                name="twitterCallbackUrl"
                                :label="$trans('config.auth.props.callback_url', {attribute: 'Twitter'})"
                                v-model:error="formErrors.twitterCallbackUrl"
                            />
                        </div>
                    </template>
                    <div class="col-span-3">
                        <BaseSwitch
                            v-model="form.enableGithubOauthLogin"
                            name="enableGithubOauthLogin"
                            :label="$trans('config.auth.props.enable_oauth', {attribute: 'Github'})"
                            v-model:error="formErrors.enableGithubOauthLogin"
                        />
                    </div>
                    <template v-if="form.enableGithubOauthLogin">
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.githubClientId"
                                name="githubClientId"
                                :label="$trans('config.auth.props.client_id', {attribute: 'Github'})"
                                v-model:error="formErrors.githubClientId"
                            />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.githubClientSecret"
                                name="githubClientSecret"
                                :label="$trans('config.auth.props.client_secret', {attribute: 'Github'})"
                                v-model:error="formErrors.githubClientSecret"
                            />
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <BaseInput
                                type="text"
                                v-model="form.githubCallbackUrl"
                                name="githubCallbackUrl"
                                :label="$trans('config.auth.props.callback_url', {attribute: 'Github'})"
                                v-model:error="formErrors.githubCallbackUrl"
                            />
                        </div>
                    </template>
                </template>
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
    sessionLifetime: '',
    loginThrottleMaxAttempts: '',
    loginThrottleLockTimeout: '',
    resetPasswordTokenLifetime: '',
    enableResetPassword: false,
    enableRegistration: false,
    enableRegistrationTerms: false,
    enableEmailVerification: false,
    enableAccountApproval: false,
    enableOauthLogin: false,
    enableGoogleOauthLogin: false,
    googleClientId: '',
    googleClientSecret: '',
    googleCallbackUrl: '',
    enableFacebookOauthLogin: false,
    facebookClientId: '',
    facebookClientSecret: '',
    facebookCallbackUrl: '',
    enableTwitterOauthLogin: false,
    twitterClientId: '',
    twitterClientSecret: '',
    twitterCallbackUrl: '',
    enableGithubOauthLogin: false,
    githubClientId: '',
    githubClientSecret: '',
    githubCallbackUrl: '',
    type: 'auth'
}

const form = reactive({ ...initForm })
</script>