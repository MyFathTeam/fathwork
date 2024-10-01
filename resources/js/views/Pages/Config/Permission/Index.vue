<template>
    <ConfigPage>

        <template #action>
            <div class="space-x-4">
                <DropdownButton direction="down" v-if="preRequisites.modules.length" :label="$trans('module.' + preRequisites.selectedModule)">
                    <div v-for="module in preRequisites.modules" :key="module.value">
                        <template v-if="module.value != route.params.module">
                            <DropdownItem as="span" @click="changeModule(module.value)">
                                {{module.label}}
                            </DropdownItem>
                        </template>
                    </div>
                </DropdownButton>
                <BaseButton @click="router.push({name: 'ConfigUserPermission'})">{{$trans('config.permission.user_permission')}}</BaseButton>
            </div>
        </template>

        <FormAction
            no-card
            :init-url="initUrl"
            action="roleWiseAssign"
            :init-form="initForm"
            :form="form"
            stay-on
        >
            <CardHeader first :title="$trans('config.permission.permission_config')" :description="$trans('config.permission.permission_info')"></CardHeader>

            <BaseLoader :is-loading="isLoading">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 sm:rounded-lg">
                    <table class="table min-w-full divide-y divide-gray-200 dark:divide-gray-700" v-if="form.assignedPermissions.length">
                        <thead class="bg-gray-50 dark:bg-neutral-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ $trans('config.permission.permission') }}</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider" v-for="role in preRequisites.roles">{{ role.label }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-dark-body divide-y divide-gray-200 dark:divide-gray-700">
                            <tr v-for="assignedPermission in form.assignedPermissions" :key="assignedPermission.name">
                                <td class="text-sm text-gray-500 dark:text-gray-400 pl-6 py-2">{{assignedPermission.name}}</td>
                                <td class="text-sm text-gray-500 dark:text-gray-400 pl-6 py-2" v-for="role in assignedPermission.roles">
                                    <BaseCheckbox v-model="role.isAssigned" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </BaseLoader>
        </FormAction>
    </ConfigPage>
</template>

<script>
export default {
    name: 'ConfigPermissionAssign'
}
</script>

<script setup>
import { reactive, onMounted, ref, watch } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useStore } from "vuex"
import { cloneDeep } from "@core/utils"

const route = useRoute()
const router = useRouter()
const store = useStore()

const isLoading = ref(false)
const initUrl = "config/permission/"
const preRequisites = reactive({
    modules: []
})
const initForm = {
    selectedModule: '',
    assignedPermissions: []
}

const form = reactive({ ...initForm })

const changeModule = (value) => {
    router.push({name: 'ConfigPermissionAssignModule', params : {module: value}})
}

const getPreRequisites = async () => {
    isLoading.value = true
    await store
        .dispatch(initUrl + "preRequisite", {
            data: route.params.module || 'general',
        })
        .then((response) => {
            isLoading.value = false
            Object.assign(preRequisites, {
                modules: response.modules,
                selectedModule: response.selectedModule,
                roles: response.roles
            })
            initForm.selectedModule = response.selectedModule
            initForm.assignedPermissions = response.assignedPermissions
            Object.assign(form, cloneDeep(initForm))
        })
        .catch((e) => {
            isLoading.value = false
        });
}

watch(
    () => route.params.module,
    (newValue) => {
        initForm.selectedModule = newValue
        Object.assign(form, cloneDeep(initForm))
        getPreRequisites()
    }
)

onMounted(() => {
    getPreRequisites()
})
</script>
