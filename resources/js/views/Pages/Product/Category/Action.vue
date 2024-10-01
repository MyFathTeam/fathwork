<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[{ label: $trans('master.category'), path: 'CategoryList' }]"
    >
        <PageHeaderAction
            name="Category"
            :title="$trans('master.category')"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <CategoryForm></CategoryForm>
    </ParentTransition>
</template>

<script>
export default {
    name: "CategoryAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import CategoryForm from "./Form.vue";

const route = useRoute();
</script>
