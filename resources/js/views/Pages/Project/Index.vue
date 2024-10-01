<template>
    <ListItem
        :init-url="initUrl"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans('project.project')"
            >
                <PageHeaderAction
                    url="projects/"
                    name="Project"
                    :title="$trans('project.project')"
                    :actions="actions"
                    :dropdown-actions="dropdownActions"
                    @toggleFilter="showFilter = ! showFilter"
                    @toggleImport="showImport = ! showImport"
                />
            </PageHeader>
        </template>

        <template #import>
            <ParentTransition appear :visibility="showImport">
                <BaseImport path="projects/import" @cancelled="showImport = false" @hide="showImport = false" @completed="emitter.emit('listItems')" />
            </ParentTransition>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable
                :header="projects.headers"
                :meta="projects.meta"
                module="project"
                @refresh="emitter.emit('listItems')"
            >
                <DataRow v-for="project in projects.data" :key="project.uuid">
                    <DataCell name="title">
                        {{ project.title }}
                    </DataCell>
                    <DataCell name="description">
                        {{ project.description }}
                    </DataCell>
                    <DataCell name="action">
                        <DropdownMenu v-if="project.isEditable || project.isDeletable || project.isReadtable || project.isCreatetable">
                            <DropdownItem project="fas fa-arrow-circle-right" v-if="project.isReadtable" @click="router.push({name: 'ProjectShow', params: {uuid: project.uuid}})">{{$trans('general.show')}}</DropdownItem>
                            <DropdownItem project="fas fa-edit" v-if="project.isEditable" @click="router.push({name: 'ProjectEdit', params: {uuid: project.uuid}})">{{$trans('general.edit')}}</DropdownItem>
                            <DropdownItem project="fas fa-copy" v-if="project.isCreatetable" @click="router.push({name: 'ProjectDuplicate', params: {uuid: project.uuid}})">{{$trans('general.duplicate')}}</DropdownItem>
                            <DropdownItem project="fas fa-trash" v-if="project.isDeletable" @click="emitter.emit('deleteItem', {
                                uuid: project.uuid
                            })">{{$trans('general.delete')}}</DropdownItem>
                        </DropdownMenu>
                    </DataCell>
                </DataRow>
                <template #actionButton>
                    <BaseButton @click="router.push({name: 'ProjectCreate'})" v-if="perform('project:create')">
                        {{$trans('global.add', {attribute: $trans('project.project')})}}
                    </BaseButton>
                </template>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'ProjectList'
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
if (perform('project:create')) {
    actions.unshift('create')
}
let dropdownActions = [];
if (perform('project:export')) {
    dropdownActions = ['print', 'pdf', 'excel']
}

const initUrl = "project/"
const showFilter = ref(false)
const showImport = ref(false)

const projects = reactive({
    data: []
})

const setItems = (data) => {
    Object.assign(projects, data)
}
</script>
