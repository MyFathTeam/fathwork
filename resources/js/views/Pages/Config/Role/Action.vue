<template>
    <ConfigPage no-background>

        <template #action>
            <PageHeaderAction
                name="ConfigRole"
                :title="$trans('config.role.role')"
                :actions="['list']"
            />
        </template>

        <ParentTransition appear :visibility="true">
            <RoleForm></RoleForm>
        </ParentTransition>
    </ConfigPage>
</template>

<script>
export default {
    name: "RoleAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import RoleForm from "./Form.vue";

const route = useRoute();
</script>
