<template>
    <ListItem :init-url="initUrl" @setItems="setItems">
        <template #header>
            <PageHeader :title="$trans('faththink.faththink')">
                <PageHeaderAction url="faththinks/" name="Faththink" :title="$trans('faththink.faththink')"
                    :dropdown-actions="dropdownActions" @toggleFilter="showFilter = !showFilter"
                    @toggleImport="showImport = !showImport" />
            </PageHeader>
        </template>

        <template #import>
            <ParentTransition appear :visibility="showImport">
                <BaseImport path="faththinks/import" @cancelled="showImport = false" @hide="showImport = false"
                    @completed="emitter.emit('listItems')" />
            </ParentTransition>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable :header="faththinks.headers" :meta="faththinks.meta" module="faththink"
                @refresh="emitter.emit('listItems')">
                <DataRow v-for="faththink in faththinks.data" :key="faththink.uuid">
                    <DataCell name="humidity">
                        {{ faththink.humidity }}
                    </DataCell>
                    <DataCell name="temperature">
                        {{ faththink.temperature }}
                    </DataCell>
                    <DataCell name="soilMoisture">
                        {{ faththink.soilMoisture }}
                    </DataCell>
                </DataRow>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'FaththinkList'
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
if (perform('faththink:create')) {
    actions.unshift('create')
}
let dropdownActions = [];
if (perform('faththink:export')) {
    dropdownActions = ['print', 'pdf', 'excel']
}

const initUrl = "faththink/"
const showFilter = ref(false)
const showImport = ref(false)

const faththinks = reactive({
    data: []
})

const setItems = (data) => {
    Object.assign(faththinks, data)
}
</script>
