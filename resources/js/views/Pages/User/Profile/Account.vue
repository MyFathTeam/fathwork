<template>
    <ParentTransition appear :visibility="true">
        <FormAction
            no-card
            :init-url="initUrl"
            :action="getAction"
            :init-form="initForm"
            :form="form"
            :after-submit="afterSubmit"
            stay-on
            redirect="Dashboard"
        >
            <template #title>
                {{$trans('user.profile.account')}}
            </template>
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        :disabled="disableInput || isSuperAdmin"
                        type="text"
                        v-model="form.username"
                        name="username"
                        :label="
                            $trans('user.profile.props.username')
                        "
                        v-model:error="formErrors.username"
                    />
                </div>
                <div class="col-span-3 sm:col-span-1">
                    <BaseInput
                        :disabled="disableInput"
                        type="text"
                        v-model="form.email"
                        name="email"
                        :label="
                            $trans('user.profile.props.email')
                        "
                        v-model:error="formErrors.email"
                    />
                </div>
                <div class="col-span-3 sm:col-span-2" v-if="existingEmailVerification">
                    <BaseInput
                        type="password"
                        v-model="form.existingEmailOtp"
                        name="existingEmailOtp"
                        :label="
                            $trans('user.profile.verification_otp', {attribute: existingUserEmail})
                        "
                        v-model:error="formErrors.existingEmailOtp"
                    />
                </div>
                <div class="col-span-3 sm:col-span-2" v-if="newEmailVerification">
                    <BaseInput
                        type="password"
                        v-model="form.newEmailOtp"
                        name="newEmailOtp"
                        :label="
                            $trans('user.profile.verification_otp', {attribute: form.email})
                        "
                        v-model:error="formErrors.newEmailOtp"
                    />
                </div>
            </div>
        </FormAction>
    </ParentTransition>
</template>

<script>
export default {
    name: 'UserAccount'
}
</script>

<script setup>
import { reactive, ref, computed } from "vue";
import { useStore } from "vuex";
import { getFormErrors, getAuthUser } from "@core/helpers/action"

const store = useStore();

const initUrl = "user/profile/"
const formErrors = getFormErrors(initUrl);
const existingUserEmail = getAuthUser('email');
const existingUsername = getAuthUser('username');
const isSuperAdmin = getAuthUser('isSuperAdmin');
const disableInput = computed(() => (existingEmailVerification.value || newEmailVerification.value) ? true : false)
const getAction = computed(() => {
    if (! isVerificationRequired.value) {
        return 'updateAccount'
    } else {
        return 'verifyAccount'
    }
})

const isVerificationRequired = ref(false)
const existingEmailVerification = ref(false)
const newEmailVerification = ref(false)
const initForm = {
    username: existingUsername.value,
    email: existingUserEmail.value,
    existingEmailOtp: '',
    newEmailOtp: ''
};

const form = reactive({ ...initForm })

const afterSubmit = (response) => {
    if (response.existingEmailVerification) {
        isVerificationRequired.value = true
        existingEmailVerification.value = true
    }

    if (response.newEmailVerification) {
        isVerificationRequired.value = true
        newEmailVerification.value = true
    }

    if (response.profileUpdated) {
        isVerificationRequired.value = false
        existingEmailVerification.value = false
        newEmailVerification.value = false
        form.existingEmailOtp = ''
        form.newEmailOtp = ''
    }
}
</script>