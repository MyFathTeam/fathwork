<template>
    <ListItem
        :init-url="initUrl"
        :pre-requisites="true"
        @setPreRequisites="setPreRequisites"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans('utility.todo.todo')"
            >
                <PageHeaderAction
                    url="utility/todos/"
                    name="UtilityTodo"
                    :title="$trans('utility.todo.todo')"
                    :actions="['create', 'filter']"
                    :bulk-actions="[
                       {name: 'delete', label: $trans('general.delete'), icon: 'fas fa-trash'},
                    ]"
                    :show-bulk-action="selected.items.length > 0 || selected.global"
                    :dropdown-actions="dropdownActions"
                    :headers="todos.headers"
                    @toggleFilter="showFilter = ! showFilter"
                    @onBulkAction="onBulkAction"
                >
                    <template #after>
                        <BaseButton design="white" v-if="perform('utility:config')" @click="router.push({name: 'UtilityConfig'})">
                            <i class="fas fa-cog"></i>
                        </BaseButton>
                        <BaseButton design="white" v-if="route.query.view != 'list'" v-tooltip="$trans('global._view', {attribute: $trans('general.views.list')})" @click="router.push({query: {view : 'list' }})">
                            <i class="fas fa-list"></i>
                        </BaseButton>
                        <BaseButton design="white" v-if="route.query.view != 'board'" v-tooltip="$trans('global._view', {attribute: $trans('general.views.board')})" @click="router.push({query: {view : 'board' }})">
                            <i class="fas fa-table"></i>
                        </BaseButton>
                    </template>
                </PageHeaderAction>
            </PageHeader>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" :pre-requisites="preRequisites" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true" v-if="route.query.view == 'list'">
            <DataTable
                @toggleSelectAll="value => selected.items = toggleSelectAll(value, selected)" @toggleGlobalSelect="selected.global = ! selected.global"
                :selected="selected"
                :header="todos.headers"
                :meta="todos.meta"
                module="utility.todo"
                @refresh="emitter.emit('listItems')"
            >
                <DataRow v-for="todo in todos.data" :key="todo.uuid">
                    <DataCell name="selectAll">
                        <BaseArrayCheckbox v-if="! selected.global" v-model:items="selected.items" :value="todo.uuid" />
                        <BaseCheckbox v-if="selected.global" v-model="selected.global" />
                    </DataCell>
                    <DataCell name="title">
                        {{ todo.title }}
                    </DataCell>
                    <DataCell name="due">
                        {{ todo.due.formatted }}
                    </DataCell>
                    <DataCell name="status">
                        <BaseBadge v-if="todo.status" design="success" :label="$trans('utility.todo.completed')" />
                        <BaseBadge v-else design="error" :label="$trans('utility.todo.incomplete')" />
                    </DataCell>
                    <DataCell name="completedAt">
                        {{ todo.completedAt?.formatted }}
                    </DataCell>
                    <DataCell name="statusUpdate">
                        <span class="space-x-1">
                            <span v-if="todo.completedAt" v-tooltip="$trans('utility.todo.mark_as_incomplete')">
                                <i class="far fa-times-circle fa-lg cursor-pointer text-danger" @click="updateStatus(todo)"></i>
                            </span>
                            <span v-else v-tooltip="$trans('utility.todo.mark_as_complete')">
                                <i class="far fa-check-circle fa-lg cursor-pointer text-success" @click="updateStatus(todo)"></i>
                            </span>
                        </span>
                    </DataCell>
                    <DataCell name="action">
                        <FloatingMenu>
                            <FloatingMenuItem v-if="todo.completedAt && ! todo.isArchived" icon="fas fa-box-archive" @click="markAsArchive(todo)">{{$trans('general.archive')}}</FloatingMenuItem>
                            <FloatingMenuItem v-if="todo.isArchived" icon="fas fa-box-open" @click="markAsUnarchive(todo)">{{$trans('general.unarchive')}}</FloatingMenuItem>
                            <FloatingMenuItem icon="fas fa-arrow-circle-right" @click="router.push({name: 'UtilityTodoShow', params: {uuid: todo.uuid}})">{{$trans('general.show')}}</FloatingMenuItem>
                            <FloatingMenuItem icon="fas fa-edit" @click="router.push({name: 'UtilityTodoEdit', params: {uuid: todo.uuid}})">{{$trans('general.edit')}}</FloatingMenuItem>
                            <FloatingMenuItem icon="fas fa-copy" @click="router.push({name: 'UtilityTodoDuplicate', params: {uuid: todo.uuid}})">{{$trans('general.duplicate')}}</FloatingMenuItem>
                            <FloatingMenuItem icon="fas fa-trash" @click="emitter.emit('deleteItem', {
                                uuid: todo.uuid
                            })">{{$trans('general.delete')}}</FloatingMenuItem>
                        </FloatingMenu>
                    </DataCell>
                </DataRow>
                <template #actionButton>
                    <BaseButton @click="router.push({name: 'UtilityTodoCreate'})">
                        {{$trans('global.add', {attribute: $trans('utility.todo.todo')})}}
                    </BaseButton>
                </template>
            </DataTable>
        </ParentTransition>

        <ParentTransition appear :visibility="true" v-if="route.query.view == 'board'">
            <BoardView :is-loading="isLoading" v-if="todos.meta" :todos="todos" :pre-requisites="preRequisites" @newListAdded="newListAdded" />
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'UilityTodoList'
}
</script>

<script setup>
import { ref, reactive, inject, watch, onMounted } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useStore } from "vuex"
import { getConfig, perform } from "@core/helpers/action"
import { initSelected, allSelected, toggleSelectAll } from "@core/helpers/table"
import BoardView from './BoardView.vue'
import FilterForm from './Filter.vue'

const route = useRoute()
const router = useRouter()
const store = useStore()

const emitter = inject('emitter')

let dropdownActions = []
if (perform('task:export')) {
    dropdownActions = ['print', 'pdf', 'excel']
}

const getTodoView = getConfig('utility.todoView')

const initUrl = "utility/todo/"
const preRequisites = reactive({
    statuses: [],
    todoLists: []
})
const isLoading = ref(false)
const showFilter = ref(false)

const todos = reactive({
    data: []
})

const selected = reactive({ ...initSelected })

const setItems = (data) => {
    Object.assign(todos, data)
    selected.items = []
    selected.pageItems = todos.data.map(todo => todo.uuid)
    isLoading.value = false
}

const getDue = (todo) => {
    return todo.dueTime ? (todo.dueDate+' '+todo.dueTime) : todo.dueDate
}

const getDueAs = (todo) => {
    return todo.dueTime ? 'datetime' : date
}

const updateStatus = async (todo) => {
    emitter.emit('actionItem', {
        uuid: todo.uuid,
        action: 'status',
        confirmation: true
    })
}

const markAsArchive = async (todo) => {
    emitter.emit('actionItem', {
        uuid: todo.uuid,
        action: 'archive',
        confirmation: true
    })
}

const markAsUnarchive = async (todo) => {
    emitter.emit('actionItem', {
        uuid: todo.uuid,
        action: 'unarchive',
        confirmation: true
    })
}

const setPreRequisites = (data) => {
    Object.assign(preRequisites, data)
}

const resetSelected = () => {
    Object.assign(selected, { ...initSelected, items: [] })
}

const onBulkAction = (action) => {
    if (action == 'delete') {
        emitter.emit('deleteItems', {
            global: selected.global,
            uuids: selected.items
        })
    }
}

const newListAdded = (data) => {
    preRequisites.todoLists.push(data)
}

const updateView = () => {
    if (route.name == 'UtilityTodoList' && (! route.query.view || route.query.view === undefined)) {
        router.push({query: {view : getTodoView.value }})
    }
}

watch(
    () => [selected.items, selected.pageItems, route.query.view],
    ([newItems, newPageItems, newQueryView], [oldItems, oldPageItems, oldQueryView]) => {
        if (newQueryView != oldQueryView) {
            updateView()

            if (newQueryView && oldQueryView !== undefined) {
                emitter.emit('listItems')
            }
        } else {
            selected.all = allSelected(selected)
        }
    }
)

onMounted(() => {
        isLoading.value = true
        updateView()
    }
)
</script>
