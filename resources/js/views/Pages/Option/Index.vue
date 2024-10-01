<template>
    <ListItem
        :init-url="initUrl"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans(route.meta.label)"
                :navs="route.meta.navs"
            >
                <PageHeaderAction
                    url="options/"
                    :name="route.meta.prefix"
                    :title="$trans(route.meta.label)"
                    :actions="['create', 'filter']"
                    :dropdown-actions="['import', 'print', 'pdf', 'excel']"
                    @toggleFilter="showFilter = ! showFilter"
                    @toggleImport="showImport = ! showImport"
                />
            </PageHeader>
        </template>

        <template #import>
            <ParentTransition appear :visibility="showImport">
                <BaseImport :path="`options/import?type=${route.meta.queryType}`" @cancelled="showImport = false" @hide="showImport = false" @completed="emitter.emit('listItems')" />
            </ParentTransition>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable :header="options.headers" :meta="options.meta" :module="route.meta.transKey" @refresh="emitter.emit('listItems')">
                <DataRow v-for="option in options.data" :key="option.uuid">
                    <DataCell name="name">
                        <div class="inline-block w-6">
                            <div class="rounded-full h-5 w-5" :style="`background-color: ${option.color};`" v-if="option.color">&nbsp;</div>
                        </div>
                        {{ option.name }}
                    </DataCell>
                    <DataCell />
                    <DataCell name="description">
                        {{ option.descriptionSummary }}
                    </DataCell>
                    <DataCell name="createdAt">
                        {{ option.createdAt.formatted }}
                    </DataCell>
                    <DataCell name="action">
                        <FloatingMenu>
                            <FloatingMenuItem icon="fas fa-edit" @click="router.push({name: `${route.meta.prefix}Edit`, params: {uuid: option.uuid}})">{{$trans('general.edit')}}</FloatingMenuItem>
                            <FloatingMenuItem icon="fas fa-trash" @click="emitter.emit('deleteItem', {
                                uuid: option.uuid
                            })">{{$trans('general.delete')}}</FloatingMenuItem>
                        </FloatingMenu>
                    </DataCell>
                </DataRow>
                <template #actionButton>
                    <BaseButton @click="router.push({name: `${route.meta.prefix}Create`})">
                        {{$trans('global.add', {attribute: $trans(route.meta.label)})}}
                    </BaseButton>
                </template>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'OptionList'
}
</script>

<script setup>
import { ref, reactive, inject } from "vue"
import { useRoute, useRouter } from "vue-router"
import FilterForm from './Filter.vue'

const route = useRoute()
const router = useRouter()

const emitter = inject('emitter')

const initUrl = "option/"
const showFilter = ref(false)
const showImport = ref(false)

const options = reactive({})

const setItems = (data) => {
    Object.assign(options, data)
}
</script>
