<template>
    <FilterForm
        :init-form="initForm"
        :form="form"
        @hide="emit('hide')"
    >
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-3 sm:col-span-1">
                <BaseInput
                    type="text"
                    v-model="form.search"
                    name="search"
                    :label="
                        $trans('general.search')
                    "
                />
            </div>
            <div class="col-span-3 sm:col-span-1">
                <DatePicker
                    v-model:start="form.startDate"
                    v-model:end="form.endDate"
                    name="dateBetween"
                    as="range"
                    :label="
                        $trans('general.date_between')
                    "
                />
            </div>
            <div class="col-span-3 sm:col-span-1">
                <BaseSelect
                    v-model="form.status"
                    name="status"
                    :label="
                        $trans('utility.todo.status')
                    "
                    :options="state.statuses"
                />
            </div>
            <div class="col-span-3 sm:col-span-1">
                <BaseSwitch
                    vertical
                    v-model="form.isArchived"
                    name="isArchived"
                    :label="$trans('general.archived')"
                />
            </div>
        </div>
    </FilterForm>
</template>

<script setup>
import { reactive } from "vue"

const emit = defineEmits(['hide'])

const props = defineProps({
    preRequisites: {
        type: Object,
        default() {
            return {}
        }
    }
})

const initForm = {
    search: '',
    startDate: '',
    endDate: '',
    status: '',
    isArchived: false
}

const form = reactive({ ...initForm })
const state = reactive({
    statuses: props.preRequisites.statuses
})
</script>
