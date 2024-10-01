<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[{ label: $trans('master.product'), path: 'ProductList' }]"
    >
        <PageHeaderAction
            name="Product"
            :title="$trans('master.product')"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <ProductForm></ProductForm>
    </ParentTransition>
</template>

<script>
export default {
    name: "ProductAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import ProductForm from "./Form.vue";

const route = useRoute();
</script>
