<template>
    <ListItem
        :init-url="initUrl"
        :pre-requisites="true"
        @setPreRequisites="setPreRequisites"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans('user.user')"
            >
                <PageHeaderAction
                    url="users/"
                    name="User"
                    :title="$trans('user.user')"
                    :actions="actions"
                    :dropdown-actions="dropdownActions"
                    @toggleFilter="showFilter = ! showFilter"
                />
            </PageHeader>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" :pre-requisites="preRequisites" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable :header="users.headers" :meta="users.meta" module="user" @refresh="emitter.emit('listItems')">
                <DataRow v-for="user in users.data" :key="user.uuid">
                    <DataCell name="name">
                        {{ user.profile.name }}
                    </DataCell>
                    <DataCell name="email">
                        {{ user.email }}
                    </DataCell>
                    <DataCell name="username">
                        {{ user.username }}
                    </DataCell>
                    <DataCell name="roles">
                        <div v-for="role in user.roles">
                            <BaseBadge :label="role.label" />
                        </div>
                    </DataCell>
                    <DataCell name="status">
                        <BaseBadge :label="user.statusDetail.label" :design="user.statusDetail.color" />
                    </DataCell>
                    <DataCell name="createdAt">
                        {{ user.createdAt.formatted }}
                    </DataCell>
                    <DataCell name="action">
                        <FloatingMenu v-if="user.isEditable || user.isDeletable">
                            <!-- <FloatingMenuItem icon="fas fa-eye" @click="router.push({name: 'UserShow', params: {uuid: user.uuid}})">{{$trans('general.show')}}</FloatingMenuItem> -->
                            <FloatingMenuItem icon="fas fa-edit" v-if="user.isEditable" @click="router.push({name: 'UserEdit', params: {uuid: user.uuid}})">{{$trans('general.edit')}}</FloatingMenuItem>
                            <FloatingMenuItem icon="fas fa-trash" v-if="user.isDeletable" @click="emitter.emit('deleteItem', {
                                uuid: user.uuid
                            })">{{$trans('general.delete')}}</FloatingMenuItem>
                        </FloatingMenu>
                    </DataCell>
                </DataRow>
                <template #actionButton>
                    <BaseButton @click="router.push({name: 'UserCreate'})" v-if="perform('user:create')">
                        {{$trans('global.add', {attribute: $trans('user.user')})}}
                    </BaseButton>
                </template>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'UserList'
}
</script>

<script setup>
import { ref, reactive, inject } from "vue"
import { useRouter } from "vue-router"
import { perform } from "@core/helpers/action"
import FilterForm from './Filter.vue'

const router = useRouter()

const emitter = inject('emitter')

let actions = ['filter']
if (perform('user:create')) {
    actions.unshift('create')
}

let dropdownActions = [];
if (perform('user:export')) {
    dropdownActions = ['print', 'pdf', 'excel']
}

const initUrl = "user/"
const preRequisites = reactive({})
const showFilter = ref(false)

const users = reactive({})

const setItems = (data) => {
    Object.assign(users, data)
}

const setPreRequisites = (data) => {
    Object.assign(preRequisites, data)
}
</script>
