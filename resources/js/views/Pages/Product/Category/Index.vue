<template>
    <ListItem
        :init-url="initUrl"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans('master.category')"
            >
                <PageHeaderAction
                    url="categorys/"
                    name="Category"
                    :title="$trans('master.category')"
                    :actions="['create', 'filter']"
                    :dropdown-actions="['import', 'print', 'pdf', 'excel']"
                    @toggleFilter="showFilter = ! showFilter"
                    @toggleImport="showImport = ! showImport"
                />
            </PageHeader>
        </template>

        <template #import>
            <ParentTransition appear :visibility="showImport">
                <BaseImport path="categorys/import" @cancelled="showImport = false" @hide="showImport = false" @completed="emitter.emit('listItems')" />
            </ParentTransition>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable
                :header="categorys.headers"
                :meta="categorys.meta"
                module="category"
                @refresh="emitter.emit('listItems')"
            >
                <DataRow v-for="category in categorys.data" :key="category.uuid">
                    <DataCell name="title">
                        {{ category.title }}
                    </DataCell>
                    <DataCell name="action">
                        <DropdownMenu>
                            <DropdownItem icon="fas fa-arrow-circle-right" @click="router.push({name: 'CategoryShow', params: {uuid: category.uuid}})">{{$trans('general.show')}}</DropdownItem>
                            <DropdownItem icon="fas fa-edit" @click="router.push({name: 'CategoryEdit', params: {uuid: category.uuid}})">{{$trans('general.edit')}}</DropdownItem>
                            <DropdownItem icon="fas fa-copy" @click="router.push({name: 'CategoryDuplicate', params: {uuid: category.uuid}})">{{$trans('general.duplicate')}}</DropdownItem>
                            <DropdownItem icon="fas fa-trash" @click="emitter.emit('deleteItem', {
                                uuid: category.uuid
                            })">{{$trans('general.delete')}}</DropdownItem>
                        </DropdownMenu>
                    </DataCell>
                </DataRow>
                <template #actionButton>
                    <BaseButton @click="router.push({name: 'CategoryCreate'})">
                        {{$trans('global.add', {attribute: $trans('master.category')})}}
                    </BaseButton>
                </template>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'CategoryList'
}
</script>

<script setup>
import { ref, reactive, inject } from "vue"
import { useRouter } from "vue-router"
import FilterForm from './Filter.vue'

const router = useRouter()

const emitter = inject('emitter')

const initUrl = "master/category/"
const showFilter = ref(false)
const showImport = ref(false)

const categorys = reactive({
    data: []
})

const setItems = (data) => {
    Object.assign(categorys, data)
}
</script>
