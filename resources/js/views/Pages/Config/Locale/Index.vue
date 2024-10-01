<template>
    <ConfigPage no-background>

        <template #action>
            <PageHeaderAction
                name="ConfigLocale"
                :title="$trans('config.locale.locale')"
                :actions="['create', 'filter']"
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
                <DataTable :header="locales.headers" :meta="locales.meta" module="config.locale" @refresh="emitter.emit('listItems')">
                    <DataRow v-for="locale in locales.data" :key="locale.uuid">
                        <DataCell name="name">
                            {{ locale.name }}
                        </DataCell>
                        <DataCell name="code">
                            {{ locale.code }}
                        </DataCell>
                        <DataCell name="action">
                            <FloatingMenu v-if="! locale.isDefault">
                                <FloatingMenuItem icon="fas fa-edit" @click="router.push({name: 'ConfigLocaleEdit', params: {uuid: locale.uuid}})">{{$trans('general.edit')}}</FloatingMenuItem>
                                <FloatingMenuItem icon="fas fa-trash" @click="emitter.emit('deleteItem', {
                                    uuid: locale.uuid
                                })">{{$trans('general.delete')}}</FloatingMenuItem>
                            </FloatingMenu>
                        </DataCell>
                    </DataRow>
                    <template #actionButton>
                        <BaseButton @click="router.push({name: 'LocaleCreate'})">
                            {{$trans('global.add', {attribute: $trans('config.locale.locale')})}}
                        </BaseButton>
                    </template>
                </DataTable>
            </ParentTransition>
        </ListItem>
    </ConfigPage>
</template>

<script>
export default {
    name: 'LocaleList'
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

const initUrl = "config/locale/"
const showFilter = ref(false)

const locales = reactive({})

const setItems = (data) => {
    Object.assign(locales, data)
}
</script>
