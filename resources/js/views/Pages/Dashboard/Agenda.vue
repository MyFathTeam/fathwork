<template>
    <BaseCard no-padding :is-loading="isLoading">
        <template #title>
            {{$trans('general.greeting_message', {name: user})}}
            <h3 class="text-2xl font-semibold">{{moment().format('ddd Do, MMM YYYY')}}</h3>
        </template>
        <template v-for="agenda in agendas">
            <div class="p-4 border-b border-gray-200 hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-neutral-700">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <div class="rounded-full p-2" :class=[agenda.color]>
                            <i :class="agenda.icon" class="text-white h-6 w-6 flex items-center justify-center"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex items-center flex-1">
                        <div>
                            <p class="dark:text-gray-400">{{agenda.title}}</p>
                            <p class="text-sm dark:text-gray-500">{{agenda.date.formatted}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </BaseCard>
</template>

<script>
export default {
    name: 'DashboardAgenda'
}
</script>

<script setup>
import { onMounted, inject, reactive, ref } from "vue"
import { useStore } from "vuex"
import { getAuthUser } from "@core/helpers/action"

const store = useStore()

const moment = inject("moment")

const user = getAuthUser('profile.name');

const isLoading = ref(false)
const agendas = reactive([])

onMounted(async () => {
    isLoading.value = true

    await store
        .dispatch("dashboard/getAgenda")
        .then((response) => {
            isLoading.value = false
            Object.assign(agendas, response)
        })
        .catch((e) => {
            isLoading.value = false
        });
})
</script>
