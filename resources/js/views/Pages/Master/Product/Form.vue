<template>
  <FormAction
    :init-url="initUrl"
    :pre-requisites="true"
    @setPreRequisites="setPreRequisites"
    :init-form="initForm"
    :form="form"
    redirect="Product"
  >
    <div class="grid grid-cols-2 gap-6">
      <div class="col-span-2">
        <BaseInput
          type="text"
          v-model="form.name"
          name="name"
          :label="$trans('master.product.props.name')"
          v-model:error="formErrors.name"
          autofocus
        />
      </div>
      <div class="col-span-2">
        <BaseSelect
          v-model="form.productcategory"
          name="productcategory"
          :label="$trans('master.productcategory.productcategory')"
          :options="preRequisites.productcategory"
          v-model:error="formErrors.productcategory"
        />
      </div>
      <div class="col-span-3 sm:col-span-2">
        <BaseTextarea
          v-model="form.description"
          name="description"
          :label="$trans('master.product.props.description')"
          v-model:error="formErrors.description"
        />
      </div>
    </div>
    <div class="grid grid-cols-1">
      <div class="col">
        <MediaUpload
          multiple
          :label="$trans('general.file')"
          module="product"
          :media="form.media"
          @setHash="(hash) => (form.mediaHash = hash)"
          @setToken="(token) => (form.mediaToken = token)"
        />
      </div>
    </div>
  </FormAction>
</template>

<script>
export default {
  name: "ProductForm",
};
</script>

<script setup>
import { reactive } from "vue";
import { getFormErrors } from "@core/helpers/action";

const initUrl = "master/product/";
const formErrors = getFormErrors(initUrl);
const preRequisites = reactive({});

const initForm = {
  name: "",
  productcategory: "",
  description: "",
  media: [],
  mediaToken: "",
  mediaHash: "",
};

const form = reactive({ ...initForm });

const setPreRequisites = (data) => {
  Object.assign(preRequisites, data);
};
</script>
