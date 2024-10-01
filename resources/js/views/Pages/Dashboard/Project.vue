<template>
    <BaseCard no-padding no-content-padding bottom-content-padding :is-loading="isLoading">
        <template #title>Projects</template>
        <template #action>
            <BaseButton size="xs">Action</BaseButton>
        </template>
        <SimpleTable :header="projects.header">
            <DataRow v-for="project in projects.data" :key="project.uuid">
                <DataCell name="select">
                    <BaseCheckbox />
                </DataCell>
                <DataCell name="members">
                    <ul class="flex flex-wrap justify-center sm:justify-start mb-8 sm:mb-0 -space-x-3 -ml-px">
                        <li v-for="member in project.members" class="border-2 border-primary rounded-full">
                            <a class="block" href="#">
                                <img class="w-8 h-8 rounded-full" v-tooltip="member.name" :src="member.path" width="36" height="36" alt="Project Member">
                            </a>
                        </li>
                    </ul>
                </DataCell>
                <DataCell name="project">
                    <div class="flex items-center">
                        <div class="rounded-full h-4 w-4" :style="`background-color: ${project.projectColor};`">&nbsp;</div>
                        <span class="ml-2">{{project.project}}</span>
                    </div>
                </DataCell>
                <DataCell name="client">
                    {{project.client}}
                </DataCell>
                <DataCell name="progress">
                    <span class="text-xs text-gray-500 dark:text-gray-400">{{project.progress}}%</span>
                    <ProgressBar :percent="project.progress" :max="100" :color="project.color" />
                </DataCell>
                <DataCell name="deadline">
                    <span class="bg-gray-400 px-2 py-1 rounded-full text-gray-50">{{project.deadline}}</span>
                </DataCell>
                <DataCell name="action">
                    <FloatingMenu>
                        <FloatingMenuItem icon="fas fa-arrow-circle-right" @click="doNothing">Show</FloatingMenuItem>
                        <FloatingMenuItem icon="fas fa-edit" @click="doNothing">Edit</FloatingMenuItem>
                        <FloatingMenuItem icon="fas fa-copy" @click="doNothing">Duplicate</FloatingMenuItem>
                        <FloatingMenuItem icon="fas fa-trash" @click="doNothing">Delete</FloatingMenuItem>
                    </FloatingMenu>
                </DataCell>
            </DataRow>
        </SimpleTable>
    </BaseCard>
</template>

<script>
export default {
    name: 'DashboardProject'
}
</script>

<script setup>
import { onMounted, reactive, ref } from "vue"
import { useStore } from "vuex"

const store = useStore()

const isLoading = ref(false)
const projects = reactive([])

const doNothing = () => {}

onMounted(async () => {
    isLoading.value = true

    await store
        .dispatch("dashboard/getProject")
        .then((response) => {
            isLoading.value = false
            Object.assign(projects, response)
        })
        .catch((e) => {
            isLoading.value = false
        });
})
</script>
