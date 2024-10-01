<template>
    <ListItem
        :init-url="initUrl"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans('auth.failed_login_attempt')"
            >
                <PageHeaderAction
                    url="failed-login-attempts/"
                    name="User"
                    :title="$trans('auth.failed_login_attempt')"
                    :actions="['filter']"
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
            <DataTable :header="items.headers" :meta="items.meta" module="auth.failed_login_attempts" @refresh="emitter.emit('listItems')">
                <DataRow v-for="item in items.data" :key="item.uuid">
                    <DataCell name="email">
                        {{ item.email }}
                    </DataCell>
                    <DataCell name="ip">
                        {{ item.ip }}
                    </DataCell>
                    <DataCell name="browser">
                        {{ item.browser }}
                    </DataCell>
                    <DataCell name="os">
                        {{ item.os }}
                    </DataCell>
                    <DataCell name="createdAt">
                        {{ item.createdAt.formatted }}
                    </DataCell>
                    <DataCell name="action">
                    </DataCell>
                </DataRow>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'FailedLoginAttemptList'
}
</script>

<script setup>
import { ref, reactive, inject } from "vue"
import { useRouter } from "vue-router"
import FilterForm from './FailedLoginAttemptFilter.vue'

const router = useRouter()

const emitter = inject('emitter')

const initUrl = "auth/failedLoginAttempt/"
const showFilter = ref(false)

const items = reactive({})

const setItems = (data) => {
    Object.assign(items, data)
}
</script>
