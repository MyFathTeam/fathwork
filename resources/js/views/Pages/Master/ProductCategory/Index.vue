<template>
    <ListItem
        :init-url="initUrl"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans('master.productcategory.productcategory')"
            >
                <PageHeaderAction
                    url="master/productcategories/"
                    name="ProductCategory"
                    :title="$trans('master.productcategory.productcategory')"
                    :actions="actions"
                    :dropdown-actions="dropdownActions"
                    @toggleFilter="showFilter = ! showFilter"
                    @toggleImport="showImport = ! showImport"
                />
            </PageHeader>
        </template>

        <template #import>
            <ParentTransition appear :visibility="showImport">
                <BaseImport path="master/productcategories/import" @cancelled="showImport = false" @hide="showImport = false" @completed="emitter.emit('listItems')" />
            </ParentTransition>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable
                :header="productcategories.headers"
                :meta="productcategories.meta"
                module="productcategory"
                @refresh="emitter.emit('listItems')"
            >
                <DataRow v-for="productcategory in productcategories.data" :key="productcategory.uuid">
                    <DataCell name="title">
                        {{ productcategory.title }}
                    </DataCell>
                    <DataCell name="action">
                        <DropdownMenu v-if="productcategory.isEditable || productcategory.isDeletable || productcategory.isReadtable || productcategory.isCreatetable">
                            <DropdownItem productcategory="fas fa-arrow-circle-right" v-if="productcategory.isReadtable" @click="router.push({name: 'ProductCategoryShow', params: {uuid: productcategory.uuid}})">{{$trans('general.show')}}</DropdownItem>
                            <DropdownItem productcategory="fas fa-edit" v-if="productcategory.isEditable" @click="router.push({name: 'ProductCategoryEdit', params: {uuid: productcategory.uuid}})">{{$trans('general.edit')}}</DropdownItem>
                            <DropdownItem productcategory="fas fa-copy" v-if="productcategory.isCreatetable" @click="router.push({name: 'ProductCategoryDuplicate', params: {uuid: productcategory.uuid}})">{{$trans('general.duplicate')}}</DropdownItem>
                            <DropdownItem productcategory="fas fa-trash" v-if="productcategory.isDeletable" @click="emitter.emit('deleteItem', {
                                uuid: productcategory.uuid
                            })">{{$trans('general.delete')}}</DropdownItem>
                        </DropdownMenu>
                    </DataCell>
                </DataRow>
                <template #actionButton>
                    <BaseButton @click="router.push({name: 'ProductCategoryCreate'})" v-if="perform('productcategory:create')">
                        {{$trans('global.add', {attribute: $trans('master.productcategory.productcategory')})}}
                    </BaseButton>
                </template>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'ProductCategoryList'
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
if (perform('productcategory:create')) {
    actions.unshift('create')
}
let dropdownActions = [];
if (perform('productcategory:export')) {
    dropdownActions = ['print', 'pdf', 'excel']
}

const initUrl = "master/productcategory/"
const showFilter = ref(false)
const showImport = ref(false)

const productcategories = reactive({
    data: []
})

const setItems = (data) => {
    Object.assign(productcategories, data)
}
</script>
