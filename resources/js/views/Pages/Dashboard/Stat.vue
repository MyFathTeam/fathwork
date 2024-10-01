<template>
    <BaseLoader :is-loading="isLoading">
        <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-4 gap-4">
            <template v-for="stat in stats">
                <div class="bg-white dark:bg-dark-header shadow rounded-lg">
                    <div class="flex items-center p-4 sm:p-6 xl:p-8">
                        <div class="shrink-0">
                            <span class="text-2xl sm:text-3xl leading-none font-semibold text-gray-900 dark:text-gray-400">{{stat.count}}</span>
                            <h3 class="mt-2 text-base font-normal text-gray-500 uppercase">{{stat.title}}</h3>
                            <div class="mt-2">
                                <span class="px-2 py-1 text-xs rounded-full text-gray-50" :class="{
                                    'bg-green-500': stat.direction == 'up',
                                    'bg-red-500': stat.direction == 'down'
                                }">
                                    <i class="fas fa-arrow-up" v-if="stat.direction == 'up'"></i>
                                    <i class="fas fa-arrow-down" v-if="stat.direction == 'down'"></i>
                                    {{stat.percent}}%
                                </span>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex items-center justify-end flex-1 font-bold">
                            <div class="rounded-full" :class=[stat.color]>
                                <i :class="stat.icon" class="text-white fa-xl h-16 w-16 flex items-center justify-center"></i>
                            </div>
                        </div>
                    </div>
                    <div v-html="stat.progress"></div>
                </div>
            </template>
        </div>
    </BaseLoader>
</template>

<script>
export default {
    name: 'DashboardStat'
}
</script>

<script setup>
import { onMounted, reactive, ref } from "vue"
import { useStore } from "vuex"

const store = useStore()

const isLoading = ref(false)
const stats = reactive([])

onMounted(async () => {
    isLoading.value = true

    await store
        .dispatch("dashboard/getStat")
        .then((response) => {
            isLoading.value = false
            Object.assign(stats, response)
        })
        .catch((e) => {
            isLoading.value = false
        });
})
</script>
