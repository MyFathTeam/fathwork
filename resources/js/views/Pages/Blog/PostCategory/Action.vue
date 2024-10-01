<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[{ label: $trans('blog.postcategory.postcategory'), path: 'PostCategoryList' }]"
    >
        <PageHeaderAction
            name="PostCategory"
            :title="$trans('blog.postcategory.postcategory')"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <PostCategoryForm></PostCategoryForm>
    </ParentTransition>
</template>

<script>
export default {
    name: "PostCategoryAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import PostCategoryForm from "./Form.vue";

const route = useRoute();
</script>
