<template>
    <div class="flex justify-between"
        :class="{
            'mt-4': topMargin,
            'px-2 pt-6 bg-white': padding
        }"
    >
        <div class="flex space-x-2 sm:space-x-4" :class="{
                'px-4 py-2' : buttonPadding
            }">
            <BaseButton :disabled="props.disabled" class="hidden sm:block" design="secondary" @click="resetForm">
                {{$trans("general.reset")}}
            </BaseButton>
            <BaseCheckbox v-if="! isUpdating && keepAdding" v-model="state.keepAdding" name="keepAdding" :label="$trans('general.keep_adding')"></BaseCheckbox>
        </div>
        <div class="space-x-2 sm:space-x-4" :class="{
                'px-4 py-2' : buttonPadding
            }">
            <BaseButton design="error" v-if="cancelAction" @click="$emit('cancelled')">
                {{$trans("general.cancel")}}
            </BaseButton>
            <BaseButton design="error" v-if="hasRedirect" @click="emitter.emit('redirect')">
                {{$trans("general.cancel")}}
            </BaseButton>
            <BaseButton :disabled="props.disabled" design="primary" type="submit" v-if="! submitText">
                <span v-if="isUpdating">{{$trans('general.update')}}</span>
                <span v-else>{{$trans("general.save")}}</span>
            </BaseButton>
            <BaseButton :disabled="props.disabled" design="primary" type="submit" v-if="submitText">
                {{submitText}}
            </BaseButton>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FormActionButton'
}
</script>

<script setup>
import { computed, reactive, inject, watch } from "vue"
import { useRoute, useRouter } from "vue-router"
import { confirmReset } from "@core/helpers/alert"

const route = useRoute()
const router = useRouter()

const emitter = inject('emitter')

const emit = defineEmits(['reset', 'cancelled'])

const props = defineProps({
    action: {
        type: String,
        defaut: ''
    },
    redirect: {
        type: [String, Object],
        default: "",
    },
    cancelAction: {
        type: Boolean,
        default: false
    },
    padding: {
        type: Boolean,
        default: false
    },
    buttonPadding: {
        type: Boolean,
        default: false
    },
    topMargin: {
        type: Boolean,
        default: false
    },
    keepAdding: {
        type: Boolean,
        default: true
    },
    disabled: {
        type: Boolean,
        default: false
    },
    submitText: {
        type: String,
        default: ''
    }
})

const userAction = computed(() => props.action || route?.meta?.type)
const isUpdating = computed(() => userAction.value === 'edit' || userAction.value === 'update')
const hasRedirect = computed(() => {
    if (typeof props.redirect === 'string' && props.redirect) {
        return true
    }

    if (typeof props.redirect === 'object' && props.redirect) {
        return true
    }

    return false
})

const state = reactive({
    keepAdding: false
})

const resetForm = async () => {
    if (await confirmReset()) {
        emitter.emit('resetForm')
    }
}

watch(
    () => state.keepAdding,
    (value) => {
        emitter.emit('keepAdding', value)
    }
)
</script>
