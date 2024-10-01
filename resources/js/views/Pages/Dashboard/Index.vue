<template>
    <div>
        <div class="px-4 pt-6 pb-16 bg-black">
            <DashboardStat />
        </div>
        <div class="-mt-16 px-4 w-full grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="col-span-2 sm:col-span-2">
                <DashboardSales />
            </div>

            <!-- <div class="col-span-2 sm:col-span-1"> -->
                <!-- <DashboardChart /> -->
            <!-- </div> -->
        </div>
        <div class="mt-4 px-4 w-full grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="col-span-1">
                <DashboardStat2 />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <DashboardChart />
            </div>
        </div>

        <div class="mt-4 px-4">
            <DashboardProject />
        </div>
    </div>
</template>

<script setup>
import DashboardStat from "./Stat.vue"
import DashboardStat2 from "./Stat2.vue"
import DashboardAgenda from "./Agenda.vue"
import DashboardChart from "./Chart.vue"
import DashboardSales from "./Sales.vue"
import DashboardProject from "./Project.vue"
</script>
