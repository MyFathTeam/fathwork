<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[...route.meta.navs, { label: $trans(route.meta.label), path: `${route.meta.prefix}List` }]"
    >
        <PageHeaderAction
            :name="route.meta.prefix"
            :title="$trans(route.meta.label)"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <OptionForm></OptionForm>
    </ParentTransition>
</template>

<script>
export default {
    name: "OptionAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import OptionForm from "./Form.vue";

const route = useRoute();
</script>
