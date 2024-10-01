<template>
    <ModuleConfig :navigations="navigations">
        <router-view />
    </ModuleConfig>
</template>

<script>
export default {
    name: 'UtilityConfig'
}
</script>

<script setup>
const navigations = [
    {
        name: 'UtilityConfigGeneral',
        icon: 'fas fa-cogs',
        label: 'config.config'
    },
    {
        name: 'UtilityConfigTodoList',
        icon: 'fas fa-chevron-right',
        label: 'utility.todo.list.list'
    },
]
</script>
