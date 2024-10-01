@ -0,0 +1,102 @@
<template>
    <ListItem :init-url="initUrl" @setItems="setItems">
        <template #header>
            <PageHeader :title="$trans('master.product.product')">
                <PageHeaderAction url="master/productproducts/" name="Product" :title="$trans('master.product.product')"
                    :actions="actions" :dropdown-actions="dropdownActions" @toggleFilter="showFilter = !showFilter"
                    @toggleImport="showImport = !showImport" />
            </PageHeader>
        </template>

        <template #import>
            <ParentTransition appear :visibility="showImport">
                <BaseImport path="master/products/import" @cancelled="showImport = false" @hide="showImport = false"
                    @completed="emitter.emit('listItems')" />
            </ParentTransition>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable :header="products.headers" :meta="products.meta" module="Product"
                @refresh="emitter.emit('listItems')">
                <DataRow v-for="product in products.data" :key="product.uuid">
                    <DataCell name="name">
                        {{ product.name }}
                    </DataCell>
                    <DataCell name="productcategory">
                        {{ product.productcategorytitle }}
                    </DataCell>
                    <DataCell name="action">
                        <DropdownMenu
                            v-if="product.isEditable || product.isDeletable || product.isReadtable || product.isCreatetable">
                            <DropdownItem product="fas fa-arrow-circle-right" v-if="product.isReadtable"
                                @click="router.push({ name: 'ProductShow', params: { uuid: product.uuid } })">
                                {{ $trans('general.show') }}</DropdownItem>
                            <DropdownItem product="fas fa-edit" v-if="product.isEditable"
                                @click="router.push({ name: 'ProductEdit', params: { uuid: product.uuid } })">
                                {{ $trans('general.edit') }}</DropdownItem>
                            <DropdownItem product="fas fa-copy" v-if="product.isCreatetable"
                                @click="router.push({ name: 'ProductDuplicate', params: { uuid: product.uuid } })">
                                {{ $trans('general.duplicate') }}</DropdownItem>
                            <DropdownItem product="fas fa-trash" v-if="product.isDeletable" @click="emitter.emit('deleteItem', {
                                uuid: product.uuid
                            })">{{ $trans('general.delete') }}</DropdownItem>
                        </DropdownMenu>
                    </DataCell>
                </DataRow>
                <template #actionButton>
                    <BaseButton @click="router.push({ name: 'ProductCreate' })" v-if="perform('product:create')">
                        {{ $trans('global.add', { attribute: $trans('master.product.product') }) }}
                    </BaseButton>
                </template>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'ProductList'
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
if (perform('product:create')) {
    actions.unshift('create')
}
let dropdownActions = [];
if (perform('product:export')) {
    dropdownActions = ['print', 'pdf', 'excel']
}

const initUrl = "master/product/"
const showFilter = ref(false)
const showImport = ref(false)

const products = reactive({
    data: []
})

const setItems = (data) => {
    Object.assign(products, data)
}
</script>