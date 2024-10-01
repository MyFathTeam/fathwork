<template>
    <ListItem
        :init-url="initUrl"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans('utility.activity.log')"
            >
                <PageHeaderAction
                    url="utility/activity-logs/"
                    name="UtilityActivityLog"
                    :title="$trans('utility.activity.log')"
                    :actions="['filter']"
                    :dropdown-actions="['print', 'pdf', 'excel']"
                    @toggleFilter="showFilter = ! showFilter"
                />
            </PageHeader>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable :header="activityLogs.headers" :meta="activityLogs.meta" module="utility.activity" @refresh="emitter.emit('listItems')">
                <DataRow v-for="activityLog in activityLogs.data" :key="activityLog.uuid">
                    <DataCell name="user">
                        {{ activityLog.user ? activityLog.user.profile.name : '-' }}
                    </DataCell>
                    <DataCell name="activity">
                        {{ activityLog.activity }}
                    </DataCell>
                    <DataCell name="ip">
                        {{ activityLog.ip }}
                    </DataCell>
                    <DataCell name="browser">
                        {{ activityLog.browser }}
                    </DataCell>
                    <DataCell name="os">
                        {{ activityLog.os }}
                    </DataCell>
                    <DataCell name="createdAt">
                        {{ activityLog.createdAt.formatted }}
                    </DataCell>
                </DataRow>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'ActivityLogList'
}
</script>

<script setup>
import { ref, reactive, inject } from "vue"
import { useRouter } from "vue-router"
import FilterForm from './Filter.vue'

const router = useRouter()

const emitter = inject('emitter')

const initUrl = "utility/activityLog/"
const showFilter = ref(false)

const activityLogs = reactive({})

const setItems = (data) => {
    Object.assign(activityLogs, data)
}
</script>
