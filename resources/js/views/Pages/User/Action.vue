<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[{ label: $trans('user.user'), path: 'UserList' }]"
    >
        <PageHeaderAction
            name="User"
            :title="$trans('user.user')"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <UserForm></UserForm>
    </ParentTransition>
</template>

<script>
export default {
    name: "UserAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import UserForm from "./Form.vue";

const route = useRoute();
</script>
