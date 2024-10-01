<template>
    <ConfigPage>

        <template #action>
            <div class="space-x-4">
                <BaseButton @click="router.push({name: 'ConfigPermission'})">{{$trans('config.permission.role_permission')}}</BaseButton>
            </div>
        </template>

        <FormAction
            no-card
            :init-url="initUrl"
            action="userWiseAssign"
            :init-form="initForm"
            :form="form"
            reset-form
            :keep-adding="false"
        >
            <CardHeader first :title="$trans('config.permission.user_permission_config')" :description="$trans('config.permission.user_permission_info')"></CardHeader>
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <BaseRadioGroup
                        :options="actionOptions"
                        name="action"
                        v-model="form.action"
                        v-model:error="formErrors.action"
                        horizontal
                    />
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <BaseSelect
                        v-model="form.users"
                        :filterResults="false"
                        :minChars="1"
                        :resolveOnLoad="false"
                        :delay="500"
                        multiple
                        name="users"
                        value-prop="uuid"
                        :options="async function(query) {
                            return await searchUser(query);
                        }"
                        :label="
                            $trans('global.select', {attribute: $trans('user.user')})
                        "
                        v-model:error="formErrors.users"
                    >
                        <template #selectedOption="slotProps">
                            {{slotProps.value.profile.name}} ({{slotProps.value.email}})
                        </template>

                        <template #listOption="slotProps">
                            {{slotProps.option.profile.name}} ({{slotProps.option.email}})
                        </template>
                    </BaseSelect>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <BaseSelect
                        v-model="form.permissions"
                        :filterResults="false"
                        :minChars="1"
                        :resolveOnLoad="false"
                        :delay="500"
                        multiple
                        name="permissions"
                        :options="async function(query) {
                            return await search(query);
                        }"
                        :label="
                            $trans('global.select', {attribute: $trans('config.permission.permission')})
                        "
                        v-model:error="formErrors.permissions"
                    />
                </div>
            </div>
        </FormAction>
    </ConfigPage>
</template>

<script>
export default {
    name: 'ConfigUserPermission'
}
</script>

<script setup>
import { reactive, inject } from "vue"
import { useRouter } from "vue-router"
import { useStore } from "vuex"
import { getFormErrors } from "@core/helpers/action"

const router = useRouter()
const store = useStore()

const $trans = inject("$trans")

const initUrl = "config/permission/"
const formErrors = getFormErrors(initUrl);

const initForm = {
    action: '',
    users: [],
    permissions: []
};

const preRequisites = reactive({})
const form = reactive({ ...initForm });

const actionOptions = [
    {label: $trans('general.assign'), 'value': 'assign'},
    {label: $trans('general.revoke'), 'value': 'revoke'},
]

const search = async (query) => {
    return await store.dispatch('config/permission/search', {
        query
    }).then((response) => {
        return response
    }).catch((e) => {})
}

const searchUser = async (query) => {
    return await store.dispatch('config/permission/searchUser', {
        query
    }).then((response) => {
        return response
    }).catch((e) => {})
}
</script>