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
        <ShowItem
            :init-url="initUrl"
            :uuid="route.params.uuid"
            @setItem="setItem"
            @redirectTo="router.push({name: 'Category'})"
        >
            <BaseCard v-if="category.uuid">
                <template #title>
                    {{category.title}}
                </template>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <BaseDataView class="col-span-1 sm:col-span-2" :label="$trans('category.props.title')">
                        <div v-html="category.title"></div>
                    </BaseDataView>

                    <BaseDataView :label="$trans('general.created_at')">
                        {{category.createdAt}}
                    </BaseDataView>

                    <BaseDataView :label="$trans('general.updated_at')">
                        {{category.updatedAt}}
                    </BaseDataView>
                </dl>
                <template #footer>
                    <ShowButton>
                        <BaseButton design="primary" @click="router.push({name: 'CategoryEdit', params: {uuid: category.uuid}})">
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
    name: "CategoryShow"
}
</script>

<script setup>
import { reactive } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const initialCategory = {};

const initUrl = "master/category/"

const category = reactive({ ...initialCategory });

const setItem = (data) => {
    Object.assign(category, data);
};
</script>
