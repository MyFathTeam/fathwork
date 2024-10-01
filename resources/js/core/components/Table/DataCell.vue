<template>
    <template v-if="hasLabel || isVisible(name)">
        <td :valign="valign" :colspan="colspan" class="dark:bg-dark-header" :class="{
            'sm:px-2 xl:px-4 py-2': ! noPadding && ! leftPadding,
            'py-3': isFooter,
            'border border-gray-200 dark:border-gray-700': bordered || isFooter,
            'hidden md:table-cell': ! noResponsive,
            'text-right': align == 'right',
            'text-center': align == 'first-letter:',
            'cursor-pointer': clickable,
        }">
            <div class="" :class="{
                'text-md font-semibold': isHeading,
                'text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider': isFooter,
                'text-sm text-gray-900 dark:text-gray-400': ! isHeading && ! isFooter,
            }">
                <slot></slot>
            </div>
        </td>

        <div v-if="! noResponsive && ! empty" class="md:hidden text-sm text-gray-900 dark:text-gray-400" :class="{
            'flex': ! streched,
            'items-center': valign == 'middle',
            'items-start': valign == 'top',
            'items-end': valign == 'bottom',
            'border border-gray-200 dark:border-gray-700': bordered,
            'mb-2': ! bordered,
            'px-2 py-2': ! noPadding && ! leftPadding,
            'pl-2 py-0': leftPadding,
            'justify-between': ! table,

        }">
            <span class="text-sm font-medium mr-6" v-if="! table && (label || getLabel(name))" :class="{
                'text-md font-semibold': isHeading
            }">{{label || getLabel(name)}}</span>
            <slot></slot>
        </div>
    </template>
</template>

<script>
export default {
    name: 'DataCell'
}
</script>

<script setup>
import { computed, inject } from "vue"

const props = defineProps({
    name: {
        type: String,
        default: ''
    },
    label: {
        type: String,
        default: ''
    },
    hasLabel: {
        type: Boolean,
        default: false
    },
    noResponsive: {
        type: Boolean,
        default: false
    },
    colspan: {
        type: Number,
        default: 1
    },
    table: {
        type: Boolean,
        default: false
    },
    isHeading: {
        type: Boolean,
        default: false
    },
    isFooter: {
        type: Boolean,
        default: false
    },
    align: {
        type: String,
        default: 'left'
    },
    verticalAlign: {
        type: String,
        default: 'top',
        validator(value) {
            return ["top", "bottom", "middle"].includes(value)
        },
    },
    bordered: {
        type: Boolean,
        default: false
    },
    noPadding: {
        type: Boolean,
        default: false
    },
    leftPadding: {
        type: Boolean,
        default: false
    },
    streched: {
        type: Boolean,
        default: false
    },
    empty: {
        type: Boolean,
        default: false
    },
    clickable: {
        type: Boolean,
        default: false
    },
})

const header = inject("Header")
const subHeader = inject("SubHeader")
const tableVerticalAlign = inject("VerticalAlign")

const valign = computed(() => {
    if (tableVerticalAlign) {
        return tableVerticalAlign.value
    }

    return verticalAlign
})

const getHeader = (name) => {
    let item = {key: '', label: '', visibility: true}
    if (! name) {
        return item
    }

    let index = header.value.findIndex(o => o.key == name);

    if (index >=0) {
        return header.value[index]
    }

    if (subHeader?.value) {
        index = subHeader.value.findIndex(o => o.key == name);
        if (index >=0) {
            return subHeader.value[index]
        }
    }

    return item
}

const isVisible = (name) => {
    let item = getHeader(name);

    if (['action', 'selectAll'].includes(item.key)) {
        return true;
    }

    return item.visibility
}

const getLabel = (name) => {
    return getHeader(name).label
}
</script>
