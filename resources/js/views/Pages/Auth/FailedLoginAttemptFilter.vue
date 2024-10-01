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
                    v-model="form.email"
                    name="email"
                    :label="
                        $trans('auth.login.props.email')
                    "
                />
            </div>
            <div class="col-span-3 sm:col-span-1">
                <BaseInput
                    type="text"
                    v-model="form.ip"
                    name="ip"
                    :label="
                        $trans('utility.activity.ip')
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
        </div>
    </FilterForm>
</template>

<script setup>
import { reactive } from "vue"

const emit = defineEmits(['hide'])

const initForm = {
    email: '',
    ip: '',
    startDate: '',
    endDate: '',
}

const form = reactive({ ...initForm })
</script>
