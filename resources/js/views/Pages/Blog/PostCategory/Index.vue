<template>
    <ListItem
        :init-url="initUrl"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans('blog.postcategory.postcategory')"
            >
                <PageHeaderAction
                    url="blog/postcategories/"
                    name="PostCategory"
                    :title="$trans('blog.postcategory.postcategory')"
                    :actions="actions"
                    :dropdown-actions="dropdownActions"
                    @toggleFilter="showFilter = ! showFilter"
                    @toggleImport="showImport = ! showImport"
                />
            </PageHeader>
        </template>

        <template #import>
            <ParentTransition appear :visibility="showImport">
                <BaseImport path="blog/postcategories/import" @cancelled="showImport = false" @hide="showImport = false" @completed="emitter.emit('listItems')" />
            </ParentTransition>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable
                :header="postcategories.headers"
                :meta="postcategories.meta"
                module="Postcategory"
                @refresh="emitter.emit('listItems')"
            >
                <DataRow v-for="postcategory in postcategories.data" :key="postcategory.uuid">
                    <DataCell name="title">
                        {{ postcategory.title }}
                    </DataCell>
                    <DataCell name="action">
                        <DropdownMenu v-if="postcategory.isEditable || postcategory.isDeletable || postcategory.isReadtable || postcategory.isCreatetable">
                            <DropdownItem postcategory="fas fa-arrow-circle-right" v-if="postcategory.isReadtable" @click="router.push({name: 'PostCategoryShow', params: {uuid: postcategory.uuid}})">{{$trans('general.show')}}</DropdownItem>
                            <DropdownItem postcategory="fas fa-edit" v-if="postcategory.isEditable" @click="router.push({name: 'PostCategoryEdit', params: {uuid: postcategory.uuid}})">{{$trans('general.edit')}}</DropdownItem>
                            <DropdownItem postcategory="fas fa-copy" v-if="postcategory.isCreatetable" @click="router.push({name: 'PostCategoryDuplicate', params: {uuid: postcategory.uuid}})">{{$trans('general.duplicate')}}</DropdownItem>
                            <DropdownItem postcategory="fas fa-trash" v-if="postcategory.isDeletable" @click="emitter.emit('deleteItem', {
                                uuid: postcategory.uuid
                            })">{{$trans('general.delete')}}</DropdownItem>
                        </DropdownMenu>
                    </DataCell>
                </DataRow>
                <template #actionButton>
                    <BaseButton @click="router.push({name: 'PostCategoryCreate'})" v-if="perform('postcategory:create')">
                        {{$trans('global.add', {attribute: $trans('blog.postcategory.postcategory')})}}
                    </BaseButton>
                </template>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'PostCategoryList'
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
if (perform('postcategory:create')) {
    actions.unshift('create')
}
let dropdownActions = [];
if (perform('postcategory:export')) {
    dropdownActions = ['print', 'pdf', 'excel']
}

const initUrl = "blog/postcategory/"
const showFilter = ref(false)
const showImport = ref(false)

const postcategories = reactive({
    data: []
})

const setItems = (data) => {
    Object.assign(postcategories, data)
}
</script>
