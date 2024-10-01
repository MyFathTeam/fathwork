<template>
    <BaseModal :show="visibility" @close="closeModal">
        <template #title>
            Session Expire
        </template>

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
                    type="password"
                    leading-icon="fas fa-key"
                    v-model="form.password"
                    name="password"
                    :label="$trans('auth.login.props.password')"
                    v-model:error="formErrors.password"
                />
                <BaseButton type="submit">{{$trans('auth.login.login')}}</BaseButton>
            </div>
        </FormAction>
    </BaseModal>
</template>

<script>
export default {
    name: 'ReLogin'
}
</script>

<script setup>
import { ref, reactive, inject, onMounted, onBeforeUnmount } from "vue"
import { useStore } from "vuex"
import { useRoute } from "vue-router"
import { getFormErrors } from "@core/helpers/action"

const store = useStore()
const route = useRoute()

const emitter = inject("emitter");

const initUrl = "auth/user/"
const formErrors = getFormErrors(initUrl)

const initForm = {
    password: ''
}

const visibility = ref(false)

const form = reactive({ ...initForm })

const closeModal = () => {
    visibility.value = false
}

const afterSubmit = () => {

}

onMounted(async () => {
    emitter.on("sessionExpire", async () => {
        // visibility.value = true
        // await store.dispatch('auth/user/setCSRF')
    });
})

onBeforeUnmount(() => {
    emitter.all.delete("sessionExpire")
})
</script>