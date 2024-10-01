<template>
    <div class="space-x-2 flex">

        <slot></slot>

        <BaseButton v-for="action in additionalActions" design="white" @click="router.push(action.path)">
            {{action.label}}
        </BaseButton>

        <BaseButton v-if="hasCreateAction" design="white" @click="router.push({name: CreateAction})">
            {{$trans('global.add', {attribute: title})}}
        </BaseButton>

        <DropdownMenu no-width top-margin v-if="showBulkAction && bulkActions.length">
            <template #clickable>
                <BaseButton design="white">
                    {{$trans('general.bulk_action')}} <i class="fas fa-chevron-down ml-2"></i>
                </BaseButton>
            </template>
            <DropdownItem :icon="bulkAction.icon" v-for="bulkAction in bulkActions" :key="bulkAction.name" @click="$emit('onBulkAction', bulkAction.name)">{{bulkAction.label}}</DropdownItem>
        </DropdownMenu>

        <BaseButton v-if="hasFilterAction" design="white" @click="$emit('toggleFilter')">
            <i class="fas fa-filter"></i>
        </BaseButton>

        <BaseButton v-if="hasConfigAction" design="white" @click="router.push({name: ConfigAction})">
            <i class="fas fa-cog"></i>
        </BaseButton>

        <BaseButton v-if="hasListAction" @click="router.push({ name: ListAction })">
            {{$trans("global.list_all", {attribute: title})}}
        </BaseButton>

        <BaseButton design="white" v-tooltip="$trans('global._view', {attribute: $trans('general.list')})" v-if="hasViewAction && route.query.view != 'list'" @click="updateURL({view: 'list'})">
            <i class="fas fa-list"></i>
        </BaseButton>
        <BaseButton design="white" v-tooltip="$trans('global._view', {attribute: $trans('general.card')})" v-if="hasViewAction && route.query.view == 'list'" @click="updateURL({view: 'card'})">
            <i class="fas fa-th-large"></i>
        </BaseButton>

        <slot name="after"></slot>

        <DropdownMenu double-top-margin :right-margin="false" no-width v-if="route.query.view != 'board' &&  columnsWithLabel.length" v-tooltip="$trans('global.select', {attribute: $trans('general.column')})">
            <template #clickable>
                <BaseButton design="white">
                    <i class="fas fa-table-columns flex justify-center items-center w-5 h-5"></i>
                </BaseButton>
            </template>

            <div v-for="(column, index) in columnsWithLabel" :key="column.key" class="px-4 py-2 text-sm flex">
                <BaseCheckbox v-model="column.visibility" :disabled="index === 0 ? true : false" :label="column.label" />
            </div>
        </DropdownMenu>

        <DropdownMenu double-top-margin :right-margin="false" no-width v-if="dropdownActions.length || $slots.dropdown">
            <template #clickable>
                <BaseButton design="white">
                    <EllipsisVerticalIcon
                        class="w-5 h-5"
                        aria-hidden="true"
                    />
                </BaseButton>
            </template>
            <DropdownItem icon="fas fa-download" v-if="hasImportAction" @click="$emit('toggleImport')">{{$trans('general.import')}}</DropdownItem>
            <DropdownItem icon="fas fa-print" v-if="hasPrintAction" @click="generateOutput('print')">{{$trans('general.print')}}</DropdownItem>
            <DropdownItem icon="fas fa-file-pdf" v-if="hasPdfAction" @click="generateOutput('pdf')">{{$trans('general.pdf')}}</DropdownItem>
            <DropdownItem icon="fas fa-file-excel" v-if="hasExcelAction" @click="generateOutput('excel')">{{$trans('general.excel')}}</DropdownItem>
            <slot name="dropdown"></slot>
        </DropdownMenu>
    </div>
</template>

<script>
export default {
    name: 'PageHeaderAction'
}
</script>

<script setup>
import { computed, useSlots } from "vue"
import { useRoute, useRouter } from "vue-router"
import { toQueryString } from "@core/helpers/array"

const slots = useSlots()
const route = useRoute()
const router = useRouter()

const emit = defineEmits(['toggleFilter', 'toggleImport', 'onBulkAction', 'refresh'])

const props = defineProps({
    name: {
        type: String,
        default: ''
    },
    url: {
        type: String,
        default: ''
    },
    title: {
        type: String,
        default: ''
    },
    configPath: {
        type: String,
        default: ''
    },
    actions: {
        type: Array,
        default: []
    },
    dropdownActions: {
        type: Array,
        default: []
    },
    additionalActions: {
        type: Array,
        default: []
    },
    showBulkAction: {
        type: Boolean,
        default: false
    },
    bulkActions: {
        type: Array,
        default: []
    },
    headers: {
        type: Array,
        default: []
    },
})

const hasViewAction = computed(() => props.actions.includes('view'))
const hasCreateAction = computed(() => props.actions.includes('create'))
const hasConfigAction = computed(() => props.actions.includes('config'))
const hasFilterAction = computed(() => props.actions.includes('filter'))
const hasListAction = computed(() => props.actions.includes('list'))
const hasImportAction = computed(() => props.dropdownActions.includes('import'))
const hasPrintAction = computed(() => props.dropdownActions.includes('print'))
const hasPdfAction = computed(() => props.dropdownActions.includes('pdf'))
const hasExcelAction = computed(() => props.dropdownActions.includes('excel'))

const CreateAction = computed(() => props.name+'Create')
const ConfigAction = computed(() => props.configPath ? props.configPath : props.name+'Config')
const ListAction = computed(() => props.name+'List')

const columnsWithLabel = computed(() => props.headers.filter(header => header.label))

const generateOutput = (action) => {
    let url = '/app/' + props.url + 'export'
    let queries = {...route.query, columns: columnsWithLabel.value.filter(header => header.visibility).map(header => header.key).join(','), output: action}
    window.open(toQueryString(url, queries), '_blank').focus();
}

const updateURL = async (query) => {
    await router.push({
        name: route.name,
        query: {
          ...route.query,
          ...query
        },
    })

    emit('refresh')
}
</script>
