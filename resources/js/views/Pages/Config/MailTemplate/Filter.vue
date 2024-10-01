<template>
    <BaseCard>
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-3 sm:col-span-1">
                <BaseInput
                    type="text"
                    v-model="form.name"
                    name="name"
                    :label="
                        $trans('config.mail.template.props.name')
                    "
                />
            </div>
        </div>
        <template #footer>
            <BaseButton design="error" class="mr-4" @click="clearFilter">{{
                $trans("general.cancel")
            }}</BaseButton>
            <BaseButton @click="updateURL">{{ $trans("general.filter") }}</BaseButton>
        </template>
    </BaseCard>
</template>

<script setup>
import { reactive, onMounted } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useStore } from "vuex"

const route = useRoute()
const router = useRouter()
const store = useStore()

const emit = defineEmits(['refresh', 'hide'])

const props = defineProps({
    preRequisites: {
        type: Object,
        default() {
            return {}
        }
    }
})

const initForm = {
    name: ''
}

const form = reactive({ ...initForm })

const clearFilter = () => {
    Object.assign(form, initForm);
    updateURL()
    emit('hide')
}

onMounted(async () => {
    Object.assign(form, {
        search: route.query.search
    });
})

const updateURL = async () => {
    await router.push({
        name: route.name,
        query: {
          ...route.query,
          ...form
        },
    })

    emit('refresh')
}
</script>
