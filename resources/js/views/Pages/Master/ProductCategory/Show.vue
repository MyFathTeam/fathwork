<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[{ label: $trans('master.productcategory.productcategory'), path: 'ProductCategoryList' }]"
    >
        <PageHeaderAction
            name="ProductCategory"
            :title="$trans('master.productcategory.productcategory')"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <ShowItem
            :init-url="initUrl"
            :uuid="route.params.uuid"
            @setItem="setItem"
            @redirectTo="router.push({name: 'ProductCategory'})"
        >
            <BaseCard v-if="productcategory.uuid">
                <template #title>
                    {{productcategory.title}}
                </template>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <BaseDataView class="col-span-1 sm:col-span-2" :label="$trans('productcategory.props.title')">
                        <div v-html="productcategory.title"></div>
                    </BaseDataView>

                    <BaseDataView :label="$trans('general.created_at')">
                        {{productcategory.createdAt}}
                    </BaseDataView>

                    <BaseDataView :label="$trans('general.updated_at')">
                        {{productcategory.updatedAt}}
                    </BaseDataView>
                </dl>
                <template #footer>
                    <ShowButton>
                        <BaseButton design="primary" @click="router.push({name: 'ProductCategoryEdit', params: {uuid: productcategory.uuid}})">
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
    name: "ProductCategoryShow"
}
</script>

<script setup>
import { reactive } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const initialProductCategory = {};

const initUrl = "master/productcategory/"

const productcategory = reactive({ ...initialProductCategory });

const setItem = (data) => {
    Object.assign(productcategory, data);
};
</script>
