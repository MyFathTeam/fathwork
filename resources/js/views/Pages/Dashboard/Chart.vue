<template>
    <BaseCard :is-loading="isLoading">
        <template #title>User Stats</template>
        <Line :data="data" :options="{responsive: true}" v-if="data.labels" />
    </BaseCard>
</template>

<script>
export default {
    name: 'DashboardChart'
}
</script>

<script setup>
import { onMounted, reactive, ref } from "vue"
import { useStore } from "vuex"
import { Line } from 'vue-chartjs'
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)

const store = useStore()

const isLoading = ref(false)
const data = reactive({})

onMounted(async () => {
    isLoading.value = true

    await store
        .dispatch("dashboard/getChart")
        .then((response) => {
            isLoading.value = false
            Object.assign(data, response)
        })
        .catch((e) => {
            isLoading.value = false
        });
})
</script>