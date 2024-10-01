<template>
    <BaseCard no-padding no-content-padding v-if="meta.total">
        <div :class="{
                'scroller-thin-x scroller-hidden scrollbar-track-transparent scrollbar-thumb-body dark:scrollbar-thumb-dm-body': scroll
            }">
            <table class="rounded-table hidden md:table min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-neutral-700">
                    <tr>
                        <template v-for="item in header">
                            <th v-if="isVisible(item)"
                                scope="col"
                                class="sm:px-2 xl:px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                                :class="{
                                    'text-right': item.align == 'right',
                                    'text-center': item.align == 'center',
                                    'cursor-pointer': item.sortable
                                }"
                                @click="updateSort(item.key)"
                            >
                                <span v-if="item.key == 'selectAll' && ! selected.global">
                                    <BaseCheckbox name="selectAll" v-model="selected.all" @change="toggleSelectAll" />
                                </span>

                                {{item.label}}
                                <span v-if="item.sortable" class="hidden xl:inline-block">
                                    <template v-if="sort == item.key">
                                        <i class="fas fa-sort-amount-down-alt" v-if="! order || order == 'asc'"></i>
                                        <i class="fas fa-sort-amount-up-alt" v-if="order == 'desc'"></i>
                                    </template>
                                    <template v-else>
                                        <i class="fas fa-arrows-alt-v"></i>
                                    </template>
                                </span>
                            </th>
                        </template>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                    <DataRow v-if="selected.global || selected.items.length > 0">
                        <DataCell name="selectAll" :colspan="100">
                            <div class="text-center">
                                {{$trans('global.record_selected', {attribute: selected.global ? meta.total : selected.items.length})}}
                                <span class="cursor-pointer underline" @click="toggleGlobalSelect">
                                    <span v-if="! selected.global">
                                        {{$trans('global.select_all_records', {attribute: meta.total})}}
                                    </span>
                                    <span v-else>
                                        {{$trans('general.unselect_all_records')}}
                                    </span>
                                </span>
                            </div>
                        </DataCell>
                    </DataRow>
                    <slot></slot>
                    <tr v-if="meta.from === null || meta.to === null">
                        <td colspan="100" class="text-sm text-center dark:bg-dark-header text-gray-500 dark:text-gray-400 py-2">{{$trans('general.errors.record_not_found')}}</td>
                    </tr>
                </tbody>
                <tfoot v-if="meta.hasFooter" class="bg-gray-50 dark:bg-neutral-700">
                    <tr>
                        <template v-for="item in header">
                            <td v-if="isVisible(item)" class="sm:px-2 xl:px-4 py-3 text-left text-xs font-medium dark:bg-dark-header text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                {{getFooterData(item.key)}}
                            </td>
                        </template>
                    </tr>
                </tfoot>
            </table>
        </div>

        <table class="md:hidden min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                <tr v-if="selected.global || selected.items.length > 0">
                    <td colspan="100">
                        <div class="text-center">
                            {{$trans('global.record_selected', {attribute: selected.global ? meta.total : selected.items.length})}}
                            <span class="cursor-pointer underline" @click="toggleGlobalSelect">
                                <span v-if="! selected.global">
                                    {{$trans('global.select_all_records', {attribute: meta.total})}}
                                </span>
                                <span v-else>
                                    {{$trans('general.unselect_all_records')}}
                                </span>
                            </span>
                        </div>
                    </td>
                </tr>
                <slot></slot>
                <tr v-if="meta.from === null || meta.to === null">
                    <td colspan="100" class="text-sm text-center text-gray-500 py-2">{{$trans('general.errors.record_not_found')}}</td>
                </tr>
            </tbody>
            <!-- <tfoot v-if="$slots.footer">
                <tr>
                    <slot name="footer"></slot>
                </tr>
            </tfoot> -->
        </table>

        <Pagination :meta="meta" @refresh="emit('refresh')"></Pagination>
    </BaseCard>

    <BaseCard v-if="meta.total === 0">
        <div class="flex flex-col justify-center items-center space-y-4 py-10 text-gray-500">
            <i class="fas fa-list fa-4x"></i>
            <p class="text-lg">{{$trans(module + '.module_title')}}</p>
            <p class="text-2xl text-gray-400 dark:text-gray-600" v-if="hasTrans(module + '.module_quote')">{{$trans(module + '.module_quote')}}</p>
            <p>{{$trans(module + '.module_description')}}</p>
            <p class="text-gray-400 dark:text-gray-600" v-if="hasTrans(module + '.module_example')">{{$trans(module + '.module_example')}}</p>
            <div>
                <slot name="actionButton"></slot>
            </div>
        </div>
    </BaseCard>
</template>

<script>
export default {
    name: 'DataTable'
}
</script>

<script setup>
import { useSlots, provide, computed, watch, onMounted, ref } from "vue"
import { useRoute, useRouter } from "vue-router"
import { hasTrans } from "@core/helpers/trans"

const route = useRoute()
const router = useRouter()
const slots = useSlots()

const emit = defineEmits(['refresh', 'toggleSelectAll', 'toggleGlobalSelect'])

const props = defineProps({
    header: {
        type: Array,
        default: []
    },
    footer: {
        type: Array,
        default: []
    },
    meta: {
        type: Object,
        default: {
            hasFooter: false,
            total: 0
        }
    },
    module: {
        type: String,
        default: ''
    },
    scroll: {
        type: Boolean,
        default: true
    },
    selected: {
        type: Object,
        default: {
            pageItems: [],
            items: [],
            all: false,
            global: false
        }
    },
    verticalAlign: {
        type: String,
        default: 'top',
        validator(value) {
            return ["top", "bottom", "middle"].includes(value)
        },
    },
})

const sort = ref(null)
const order = ref(null)

provide("Header", computed(() => props.header))
provide("SubHeader", [])
provide("VerticalAlign", computed(() => props.verticalAlign))

onMounted(() => {
    sort.value = route.query.sort ?? null
    order.value = route.query.order ?? null
})

const toggleSelectAll = ($event) => {
    emit('toggleSelectAll', $event.target.checked)
}

const toggleGlobalSelect = () => {
    emit('toggleGlobalSelect')
}

const getFooterData = (key) => {
    let column = props.footer.find(o => o.key == key)

    if (column === undefined) {
        return
    }

    return column.hasOwnProperty('label') ? column.label : ''
}

const isVisible = (item) => {
    if (['action', 'selectAll'].includes(item.key)) {
        return true;
    }

    if (item.hasOwnProperty('printable') && item.printable === true) {
        return false
    }

    return item.visibility
}

const updateSort = (key) => {
    let column = props.header.find(o => o.key == key)

    if (column === undefined) {
        return
    }

    if (! column.hasOwnProperty('sortable') || column.sortable !== true) {
        return
    }

    sort.value = key

    if (route.query.sort != key) {
        order.value = 'asc'
        updateURL({ sort: key, order: 'asc' })
    } else {
        if (route.query.order === undefined || route.query.order == 'desc') {
            order.value = 'asc'
            updateURL({ sort: key, order: 'asc' })
        } else {
            order.value = 'desc'
            updateURL({ sort: key, order: 'desc' })
        }
    }
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
