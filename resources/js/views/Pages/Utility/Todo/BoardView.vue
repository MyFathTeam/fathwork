<template>
    <KanBanView :add-list="perform('utility:config') ? true : false">
        <template #addListTitle>
            {{$trans('global.add', {attribute: $trans('utility.todo.list.list')})}}
        </template>
        <template #addListForm>
            <UtilityTodoListForm @completed="newListAdded" />
        </template>

        <draggable
            class="flex space-x-2"
            :list="state.lists"
            @change="listChange"
            item-key="uuid"
            :disabled="perform('utility:config') ? false : true"
        >
            <template #item="{ element }">
                <div class="flex-shrink-0 flex flex-col p-3 w-80 bg-gray-100 dark:bg-neutral-800 rounded-md h-[calc(100vh_-_250px)]">
                    <h3 class="pb-2 text-sm font-medium text-gray-900 dark:text-gray-300" :class="{
                        'cursor-move': perform('utility:config') ? true : false
                    }">
                        {{element.name}}
                    </h3>
                    <div class="flex-1 min-h-0 scroller-thin-y scroller-hidden">
                        <draggable
                            class="mt-2 space-y-3"
                            :list="element.items"
                            group="items"
                            @change="itemChange"
                            item-key="uuid"
                        >
                            <template #header>
                                <div class="mt-2 p-2 rounded-md border-dashed border-2 border-gray-400 dark:border-gray-500 text-gray-400 dark:text-gray-500 text-sm" v-if="element.items.length === 0">
                                    {{$trans('utility.todo.list.info_empty')}}
                                </div>
                            </template>
                            <template #item="{ element }">
                                <div class="bg-white dark:bg-dark-body text-gray-700 dark:text-gray-400 rounded-md shadow-sm border-2" :class="{
                                    'border-success': element.completedAt,
                                    'border-danger': element.isOverdue,
                                    'border-warning': element.isDueToday,
                                    'border-gray-400': ! element.completedAt && ! element.isOverdue && ! element.isDueToday,
                                }">
                                    <div class="p-3 space-y-2">
                                        <p class="text-sm cursor-pointer" @click="router.push({name: 'UtilityTodoShow', params: {uuid: element.uuid}})">
                                            {{element.title}}
                                        </p>
                                        <div class="text-xs flex justify-between">
                                            <div class="space-x-2">
                                                <span class="cursor-move" v-tooltip="$trans('general.move')"><i class="fas fa-arrows-up-down-left-right text-gray-400 dark:text-gray-900"></i></span>
                                                <span v-if="element.isOverdue" class="font-medium" v-tooltip="element.overdueDaysDisplay"><i class="far fa-clock"></i> {{element.due.formatted}}</span>
                                                <span v-else><i class="far fa-clock"></i> {{element.due.formatted}}</span>
                                            </div>
                                            <span class="space-x-2">
                                                <span v-if="element.completedAt" v-tooltip="$trans('utility.todo.mark_as_incomplete')">
                                                    <i class="far fa-times-circle fa-lg cursor-pointer text-danger" @click="updateStatus(element)"></i>
                                                </span>
                                                <span v-else v-tooltip="$trans('utility.todo.mark_as_complete')">
                                                    <i class="far fa-check-circle fa-lg cursor-pointer text-success" @click="updateStatus(element)"></i>
                                                </span>
                                                <span v-if="element.completedAt && ! element.isArchived" v-tooltip="$trans('general.archive')">
                                                    <i class="fas fa-box-archive cursor-pointer text-gray-400" @click="markAsArchive(element)"></i>
                                                </span>
                                                <span v-if="element.isArchived" v-tooltip="$trans('general.unarchive')">
                                                    <i class="fas fa-box-open cursor-pointer text-gray-400" @click="markAsUnarchive(element)"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </draggable>
                    </div>
                </div>
            </template>
        </draggable>
    </KanBanView>
</template>

<script>
export default {
    name: 'UtilityTodoListBoardView'
}
</script>

<script setup>
import { reactive, inject, watch, onMounted } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useStore } from "vuex"
import draggable from 'vuedraggable'
import { perform } from "@core/helpers/action"
import UtilityTodoListForm from './ListForm.vue'

const route = useRoute()
const router = useRouter()
const store = useStore()

const emitter = inject('emitter')

const emit = defineEmits(['newListAdded'])

const props = defineProps({
    todos: {
        type: Object,
        default() {
            return {
                data: []
            }
        }
    },
    preRequisites: {
        type: Object,
        default: () => ({})
    },
    isLoading: {
        type: Boolean,
        default: false
    }
})

const state = reactive({
    lists: [],
    emptyList: []
})

const setState = () => {
    state.lists = []

    let columns = [
        {name: 'Uncategorized', uuid: 'uncategorized', items: []},
    ]

    props.preRequisites.todoLists.forEach(list => {
        columns.push({name: list.name, uuid: list.uuid, items: []})
    })

    props.todos.data.forEach(todo => {
        if (todo.list?.uuid) {
            let list = columns.find(list => list.name == todo.list.name)
            if (list) {
                list.items.push(todo)
            } else {
                columns.push({name: todo.list.name, uuid: todo.list.uuid, items: [todo]})
            }
        } else {
            columns.find(list => list.name === 'Uncategorized').items.push(todo)
        }
    })

    if (columns.find(list => list.name === 'Uncategorized').items.length === 0) {
        columns = columns.filter(list => list.name !== 'Uncategorized')
    }

    state.lists = columns
}

const listChange = (event) => {
    let uuids = state.lists.map(list => list.uuid)
    store.dispatch('utility/todo/reorderList', {uuids: uuids})
        .then(response => {})
        .catch(error => {})
}

const itemChange = (event) => {
    let oldIndex = 0
    if (event.removed) {
        oldIndex = event.removed.oldIndex
    }

    if (event.added) {
        let uuid = event.added.element.uuid
        let oldListUuid = event.added.element.list?.uuid
        let listUuid = null
        let itemUuids = []
        state.lists.forEach(list => {
            if (list.items.find(item => item.uuid === uuid)) {
                listUuid = list.uuid
                itemUuids = list.items.map(item => item.uuid)
            }
        })

        store.dispatch('utility/todo/moveList', {uuid: uuid, listUuid: listUuid, itemUuids: itemUuids})
            .then(response => {})
            .catch(error => {
                if (oldListUuid === undefined) {
                    oldListUuid = 'uncategorized'
                }
                let oldList = state.lists.find(list => list.uuid === oldListUuid)
                oldList.items.splice(oldIndex, 0, event.added.element)

                let newList = state.lists.find(list => list.uuid === listUuid)
                newList.items = newList.items.filter(item => item.uuid !== uuid)
            })
    }

    if (event.moved) {
        let uuid = event.moved.element.uuid
        let listUuid = event.moved.element.list?.uuid || 'uncategorized'
        let list = state.lists.find(list => list.uuid === listUuid)
        let itemUuids = list.items.map(item => item.uuid)
        store.dispatch('utility/todo/reorderItems', {uuids: itemUuids})
            .then(response => {})
            .catch(error => {})
    }
}

const newListAdded = (data) => {
    emit('newListAdded', data.option)
    state.lists.push({name: data.option.name, uuid: data.option.uuid, items: []})
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

watch (
    () => props.todos,
    (value) => {
        setState()
    },
    {deep: true}
)

onMounted(() => {
    setState()
})
</script>
