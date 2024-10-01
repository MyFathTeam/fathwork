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
                    v-model="form.name"
                    name="name"
                    :label="
                        $trans('user.props.name')
                    "
                />
            </div>
            <div class="col-span-3 sm:col-span-1">
                <BaseInput
                    type="text"
                    v-model="form.email"
                    name="email"
                    :label="
                        $trans('user.props.email')
                    "
                />
            </div>
            <div class="col-span-3 sm:col-span-1">
                <BaseInput
                    type="text"
                    v-model="form.username"
                    name="username"
                    :label="
                        $trans('user.props.username')
                    "
                />
            </div>
            <div class="col-span-3 sm:col-span-1">
                <BaseSelect
                    v-model="form.status"
                    name="status"
                    :label="
                        $trans('user.status')
                    "
                    :options="state.statuses"
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
    name: '',
    email: '',
    username: '',
    status: ''
}

const form = reactive({ ...initForm })
const state = reactive({
    statuses: props.preRequisites.statuses
})
</script>