<template>
    <ConfigPage no-background>

        <template #action>
            <PageHeaderAction
                name="ConfigMailTemplate"
                :title="$trans('config.mail.template.template')"
                :actions="['filter']"
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
                <DataTable :header="mailTemplates.headers" :meta="mailTemplates.meta" module="config.mail.template" @refresh="emitter.emit('listItems')">
                    <DataRow v-for="mailTemplate in mailTemplates.data" :key="mailTemplate.uuid">
                        <DataCell name="name">
                            {{ mailTemplate.name }}
                        </DataCell>
                        <DataCell name="subject">
                            {{ mailTemplate.subject }}
                        </DataCell>
                        <DataCell name="action">
                            <FloatingMenu>
                                <FloatingMenuItem icon="fas fa-arrow-circle-right" as="link" target="_blank" :href="`/app/config/mail-template/${mailTemplate.uuid}`">{{$trans('general.show')}}</FloatingMenuItem>
                                <FloatingMenuItem icon="fas fa-edit" @click="router.push({name: 'ConfigMailTemplateEdit', params: {uuid: mailTemplate.uuid}})">{{$trans('general.edit')}}</FloatingMenuItem>
                            </FloatingMenu>
                        </DataCell>
                    </DataRow>
                    <template #actionButton>
                    </template>
                </DataTable>
            </ParentTransition>
        </ListItem>
    </ConfigPage>
</template>

<script>
export default {
    name: 'ConfigMailTemplateList'
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

const initUrl = "config/mailTemplate/"
const showFilter = ref(false)

const mailTemplates = reactive({})

const setItems = (data) => {
    Object.assign(mailTemplates, data)
}
</script>
