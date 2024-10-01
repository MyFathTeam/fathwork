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
        <ShowItem
            :init-url="initUrl"
            :uuid="route.params.uuid"
            @setItem="setItem"
            @redirectTo="router.push({name: 'PostCategory'})"
        >
            <BaseCard v-if="postcategory.uuid">
                <template #title>
                    {{postcategory.title}}
                </template>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <BaseDataView class="col-span-1 sm:col-span-2" :label="$trans('postcategory.props.title')">
                        <div v-html="postcategory.title"></div>
                    </BaseDataView>

                    <BaseDataView :label="$trans('general.created_at')">
                        {{postcategory.createdAt}}
                    </BaseDataView>

                    <BaseDataView :label="$trans('general.updated_at')">
                        {{postcategory.updatedAt}}
                    </BaseDataView>
                </dl>
                <template #footer>
                    <ShowButton>
                        <BaseButton design="primary" @click="router.push({name: 'PostCategoryEdit', params: {uuid: postcategory.uuid}})">
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
    name: "PostCategoryShow"
}
</script>

<script setup>
import { reactive } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const initialPostCategory = {};

const initUrl = "blog/postcategory/"

const postcategory = reactive({ ...initialPostCategory });

const setItem = (data) => {
    Object.assign(postcategory, data);
};
</script>
