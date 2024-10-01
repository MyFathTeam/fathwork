<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[{ label: $trans('blog.post.post'), path: 'PostList' }]"
    >
        <PageHeaderAction
            name="Post"
            :title="$trans('blog.post.post')"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <PostForm></PostForm>
    </ParentTransition>
</template>

<script>
export default {
    name: "PostAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import PostForm from "./Form.vue";

const route = useRoute();
</script>
