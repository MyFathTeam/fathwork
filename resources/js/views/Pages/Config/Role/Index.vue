<template>
    <ConfigPage no-background>

        <template #action>
            <PageHeaderAction
                url="config/roles/"
                name="ConfigRole"
                :title="$trans('config.role.role')"
                :actions="['create', 'filter']"
                :dropdown-actions="['print', 'pdf', 'excel']"
                @toggleFilter="showFilter = ! showFilter"
            />
        </template>

        <ListItem
            class="sm:-mt-4"
            :init-url="initUrl"
            @setItems="setItems"
        >
            <template #filter>
                <ParentTransition appear :visibility="showFilter">
                    <FilterForm @refresh="emitter.emit('listItems')" @hide="showFilter = false"></FilterForm>
                </ParentTransition>
            </template>

            <ParentTransition appear :visibility="true">
                <DataTable :header="roles.headers" :meta="roles.meta" module="config.role" @refresh="emitter.emit('listItems')">
                    <DataRow v-for="role in roles.data" :key="role.uuid">
                        <DataCell name="name">
                            {{ role.label }}
                        </DataCell>
                        <DataCell name="isDefault">
                            <BaseBadge v-if="role.isDefault" design="primary" :label="$trans('config.role.predefined')" />
                        </DataCell>
                        <DataCell name="action">
                            <FloatingMenu v-if="! role.isDefault">
                                <FloatingMenuItem icon="fas fa-trash" @click="emitter.emit('deleteItem', {
                                    uuid: role.uuid
                                })">{{$trans('general.delete')}}</FloatingMenuItem>
                            </FloatingMenu>
                        </DataCell>
                    </DataRow>
                    <template #actionButton>
                        <BaseButton @click="router.push({name: 'RoleCreate'})">
                            {{$trans('global.add', {attribute: $trans('config.role.role')})}}
                        </BaseButton>
                    </template>
                </DataTable>
            </ParentTransition>
        </ListItem>
    </ConfigPage>
</template>

<script>
export default {
    name: 'RoleList'
}
</script>

<script setup>
import { ref, reactive, inject } from "vue"
import { useRouter } from "vue-router"
import { useStore } from "vuex"
import FilterForm from './Filter.vue'

const router = useRouter()
const store = useStore()

const emitter = inject('emitter')

const initUrl = "config/role/"
const showFilter = ref(false)

const roles = reactive({})

const setItems = (data) => {
    Object.assign(roles, data)
}
</script>
