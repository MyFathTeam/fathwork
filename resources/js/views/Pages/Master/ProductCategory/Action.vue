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
        <ProductCategoryForm></ProductCategoryForm>
    </ParentTransition>
</template>

<script>
export default {
    name: "ProductCategoryAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import ProductCategoryForm from "./Form.vue";

const route = useRoute();
</script>
