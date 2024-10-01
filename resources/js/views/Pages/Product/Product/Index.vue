<template>
    <ListItem
        :init-url="initUrl"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans('master.product')"
            >
                <PageHeaderAction
                    url="products/"
                    name="Product"
                    :title="$trans('master.product')"
                    :actions="['create', 'filter']"
                    :dropdown-actions="['import', 'print', 'pdf', 'excel']"
                    @toggleFilter="showFilter = ! showFilter"
                    @toggleImport="showImport = ! showImport"
                />
            </PageHeader>
        </template>

        <template #import>
            <ParentTransition appear :visibility="showImport">
                <BaseImport path="products/import" @cancelled="showImport = false" @hide="showImport = false" @completed="emitter.emit('listItems')" />
            </ParentTransition>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable
                :header="products.headers"
                :meta="products.meta"
                module="product"
                @refresh="emitter.emit('listItems')"
            >
                <DataRow v-for="product in products.data" :key="product.uuid">
                    <DataCell name="name">
                        {{ product.name }}
                    </DataCell>
                    <DataCell name="action">
                        <DropdownMenu>
                            <DropdownItem icon="fas fa-arrow-circle-right" @click="router.push({name: 'ProductShow', params: {uuid: product.uuid}})">{{$trans('general.show')}}</DropdownItem>
                            <DropdownItem icon="fas fa-edit" @click="router.push({name: 'ProductEdit', params: {uuid: product.uuid}})">{{$trans('general.edit')}}</DropdownItem>
                            <DropdownItem icon="fas fa-copy" @click="router.push({name: 'ProductDuplicate', params: {uuid: product.uuid}})">{{$trans('general.duplicate')}}</DropdownItem>
                            <DropdownItem icon="fas fa-trash" @click="emitter.emit('deleteItem', {
                                uuid: product.uuid
                            })">{{$trans('general.delete')}}</DropdownItem>
                        </DropdownMenu>
                    </DataCell>
                </DataRow>
                <template #actionButton>
                    <BaseButton @click="router.push({name: 'ProductCreate'})">
                        {{$trans('global.add', {attribute: $trans('master.product')})}}
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
import FilterForm from './Filter.vue'

const router = useRouter()

const emitter = inject('emitter')

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
