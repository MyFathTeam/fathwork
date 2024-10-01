<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[
            { label: $trans('utility.utility'), path: 'Utility' },
            { label: $trans('utility.todo.todo'), path: 'UtilityTodoList' }
        ]"
    >
        <PageHeaderAction
            name="UtilityTodo"
            :title="$trans('utility.todo.todo')"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <ShowItem
            :init-url="initUrl"
            :uuid="route.params.uuid"
            @setItem="setItem"
            @redirectTo="router.push({name: 'Todo'})"
        >
            <BaseCard v-if="todo.uuid">
                <template #title>
                    {{todo.title}}
                </template>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <BaseDataView :label="$trans('utility.todo.due')">
                        {{todo.due.formatted}}
                    </BaseDataView>

                    <BaseDataView>
                        <BaseBadge v-if="todo.status" design="success" :label="$trans('utility.todo.completed')" />
                        <BaseBadge v-else design="error" :label="$trans('utility.todo.incomplete')" />
                    </BaseDataView>

                    <BaseDataView class="col-span-1 sm:col-span-2" :label="$trans('utility.todo.props.description')">
                        <div v-html="todo.description"></div>
                    </BaseDataView>

                    <BaseDataView :label="$trans('general.created_at')">
                        {{todo.createdAt.formatted}}
                    </BaseDataView>

                    <BaseDataView :label="$trans('general.updated_at')">
                        {{todo.updatedAt.formatted}}
                    </BaseDataView>
                </dl>
                <template #footer>
                    <ShowButton>
                        <BaseButton design="primary" @click="router.push({name: 'UtilityTodoEdit', params: {uuid: todo.uuid}})">
                            {{$trans("general.edit")}}
                        </BaseButton>
                    </ShowButton>
                </template>
            </BaseCard>
        </ShowItem>
    </ParentTransition>
</template>

<script>
export default {
    name: "TodoShow"
}
</script>

<script setup>
import { reactive, computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStore } from "vuex";

const store = useStore();
const route = useRoute();
const router = useRouter();

const initialTodo = {};

const initUrl = "utility/todo/"

const todo = reactive({ ...initialTodo });

const setItem = (data) => {
    Object.assign(todo, data);
};
</script>
