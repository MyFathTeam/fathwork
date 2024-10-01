<template>
    <GuestHeader :label="$trans('auth.password.password_title')"></GuestHeader>

    <ParentTransition appear :visibility="true">
        <FormAction
            no-card
            no-action-button
            :init-url="initUrl"
            :init-form="initForm"
            :form="form"
            :action="getAction"
            stay-on
            :after-submit="afterSubmit"
        >
            <div class="space-y-6">
                <BaseInput
                    type="text"
                    leading-icon="fas fa-envelope"
                    v-model="form.email"
                    name="email"
                    :label="$trans('auth.password.props.email')"
                    v-model:error="formErrors.email"
                    :readonly="isPasswordRequestSent || isResetTokenConfirmed"
                    autofocus
                />

                <template v-if="isPasswordRequestSent">
                    <BaseInput
                        type="text"
                        leading-icon="fas fa-keyboard"
                        v-model="form.code"
                        name="code"
                        :label="$trans('auth.password.props.code')"
                        v-model:error="formErrors.code"
                        :readonly="isResetTokenConfirmed"
                    />
                </template>

                <template v-if="isResetTokenConfirmed">
                    <BaseInput
                        type="password"
                        leading-icon="fas fa-key"
                        v-model="form.newPassword"
                        name="newPassword"
                        :label="$trans('auth.password.props.new_password')"
                        v-model:error="formErrors.newPassword"
                    />

                    <BaseInput
                        type="password"
                        leading-icon="fas fa-key"
                        v-model="form.newPasswordConfirmation"
                        name="newPasswordConfirmation"
                        :label="$trans('auth.password.props.new_password_confirmation')"
                        v-model:error="formErrors.newPasswordConfirmation"
                    />
                </template>

                <BaseLink to="Login">{{$trans('auth.login.login_title')}}</BaseLink>

                <div v-if="isResetTokenConfirmed">
                    <BaseButton type="submit" block>{{$trans('auth.password.reset_password')}}</BaseButton>
                </div>
                <div v-else-if="isPasswordRequestSent">
                    <BaseButton type="submit" block>{{$trans('auth.password.verify_token')}}</BaseButton>
                </div>
                <div v-else>
                    <BaseButton type="submit" block>{{$trans('auth.password.request_password')}}</BaseButton>
                </div>
            </div>
        </FormAction>
    </ParentTransition>
</template>

<script setup>
import { computed, reactive } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import { getFormErrors } from "@core/helpers/action"

const store = useStore()
const router = useRouter()

const initUrl = "auth/password/"
const formErrors = getFormErrors(initUrl)
const isPasswordRequestSent = computed(() => store.getters['auth/password/isPasswordRequestSent'])
const isResetTokenConfirmed = computed(() => store.getters['auth/password/isResetTokenConfirmed'])
const getAction = computed(() => {
    if (isResetTokenConfirmed.value) {
        return 'resetPassword'
    } else if (isPasswordRequestSent.value) {
        return 'resetTokenConfirm'
    } else {
        return 'passwordRequest'
    }
})

const initForm = {
    email: '',
    code: '',
    newPassword: '',
    newPasswordConfirmation: ''
}

const form = reactive({ ...initForm })

const afterSubmit = () => {
    if (form.newPassword) {
        Object.assign(form, initForm);
        router.push({name: 'Login'})
    }
}
</script>
