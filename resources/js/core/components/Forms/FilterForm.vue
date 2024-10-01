<template>
    <BaseCard>
        <slot></slot>
        <template #footer>
            <BaseButton design="error" class="mr-4" @click="clearFilter">{{
                $trans("general.cancel")
            }}</BaseButton>
            <BaseButton @click="updateURL">{{ $trans("general.filter") }}</BaseButton>
        </template>
    </BaseCard>
</template>

<script>
export default {
    name: 'FilterForm'
}
</script>

<script setup>
import { inject, onMounted, onBeforeUnmount } from "vue"
import { useRoute, useRouter } from "vue-router"
import { cloneDeep } from "@core/utils"

const route = useRoute()
const router = useRouter()

const emitter = inject('emitter')

const emit = defineEmits(['hide', 'afterFilter'])

const props = defineProps({
    form: {
        type: Object,
        default() {
            return {

            }
        }
    },
    initForm: {
        type: Object,
        default() {
            return {

            }
        }
    },
    multiple: {
        type: Array,
        default: []
    }
})

const clearFilter = () => {
    Object.assign(props.form, props.initForm);
    updateURL()
    emit('hide')
}

const updateURL = async () => {
    let filters = {}
    Object.assign(filters, cloneDeep(route.query), cloneDeep(props.form))

    let queryString = []
    Object.entries(filters).forEach(([key, value]) => {
        if (value !== '' && value !== null) {
            queryString[key] = Array.isArray(value) ? value.join(',') : value
        }
    })

    await router.push({
        name: route.name,
        query: {
          ...queryString
        },
    })

    emit('afterFilter')
    emitter.emit('listItems')
}

onMounted(async () => {
    emitter.on("resetFilter", () => {
        clearFilter()
    });

    let filters = []
    Object.entries(route.query).forEach(([key, value]) => {
        if (! props.multiple.includes(key)) {
            filters[key] = value;
        } else {
            if (Array.isArray(value)) {
                filters[key] = value
            } else {
                filters[key] = value ? value.split(',') : []
            }
        }
    })

    Object.assign(props.form, {...filters});
})

onBeforeUnmount(() => {
    emitter.all.delete("resetFilter")
})
</script>
