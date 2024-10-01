<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[{ label: $trans('utility.todo.todo'), path: 'UtilityTodoList' }]"
    >
        <PageHeaderAction
            name="UtilityTodo"
            :title="$trans('utility.todo.todo')"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <TodoForm></TodoForm>
    </ParentTransition>
</template>

<script>
export default {
    name: "TodoAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import TodoForm from "./Form.vue";

const route = useRoute();
</script>
