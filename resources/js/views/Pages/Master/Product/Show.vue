<template>
  <PageHeader
    :title="
      $trans(route.meta.trans, {
        attribute: $trans(route.meta.label),
      })
    "
    :navs="[{ label: $trans('master.product.product'), path: 'ProductList' }]"
  >
    <PageHeaderAction
      name="Product"
      :title="$trans('master.product.product')"
      :actions="['list']"
    />
  </PageHeader>

  <ParentTransition appear :visibility="true">
    <ShowItem
      :init-url="initUrl"
      :uuid="route.params.uuid"
      @setItem="setItem"
      @redirectTo="router.push({ name: 'Product' })"
    >
      <BaseCard v-if="product.uuid">
        <template #name>
          {{ product.name }}
        </template>
        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
          <BaseDataView :label="$trans('master.product.props.name')">
            <div v-html="product.name"></div>
          </BaseDataView>

          <BaseDataView :label="$trans('master.product.props.description')">
            <div v-html="product.description"></div>
          </BaseDataView>

          <BaseDataView
            :label="$trans('master.productcategory.productcategory')"
          >
            <div v-html="product.productcategorytitle"></div>
          </BaseDataView>

          <BaseDataView class="col-span-1 sm:col-span-2">
            <ListMedia
              :media="product.media"
              :url="`/app/master/products/${product.uuid}/`"
            />
          </BaseDataView>

          <BaseDataView :label="$trans('general.created_at')">
            {{ product.createdAt }}
          </BaseDataView>

          <BaseDataView :label="$trans('general.updated_at')">
            {{ product.updatedAt }}
          </BaseDataView>
        </dl>
        <template #footer>
          <ShowButton>
            <BaseButton
              design="primary"
              @click="
                router.push({
                  name: 'ProductEdit',
                  params: { uuid: product.uuid },
                })
              "
            >
              {{ $trans("general.edit") }}
            </BaseButton>
          </ShowButton>
        </template>
      </BaseCard>
    </ShowItem>
  </ParentTransition>
</template>

<script>
export default {
  name: "ProductShow",
};
</script>

<script setup>
import { reactive } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const initialProduct = {};

const initUrl = "master/product/";

const product = reactive({ ...initialProduct });

const setItem = (data) => {
  Object.assign(product, data);
};
</script>
