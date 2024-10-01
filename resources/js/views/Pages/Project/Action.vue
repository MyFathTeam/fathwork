<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[{ label: $trans('project.project'), path: 'ProjectList' }]"
    >
        <PageHeaderAction
            name="Project"
            :title="$trans('project.project')"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <ProjectForm></ProjectForm>
    </ParentTransition>
</template>

<script>
export default {
    name: "ProjectAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import ProjectForm from "./Form.vue";

const route = useRoute();
</script>
