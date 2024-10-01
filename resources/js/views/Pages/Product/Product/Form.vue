<template>
  <FormAction
    :pre-requisites="true"
    @setPreRequisites="setPreRequisites"
    :init-url="initUrl"
    :init-form="initForm"
    :form="form"
    redirect="City"
  >
    <div class="grid grid-cols-2 gap-6">
      <div class="col-span-2">
        <BaseInput
          type="text"
          v-model="form.name"
          name="name"
          :label="$trans('master.city.props.name')"
          v-model:error="formErrors.name"
          autofocus
        />
      </div>
      <div class="col-span-2">
        <BaseSelect
          v-model="form.category"
          name="category"
          :label="$trans('master.productcategory.productcategory')"
          :options="preRequisites.category"
          v-model:error="formErrors.category"
        />
      </div>
      <div class="col-span-3 sm:col-span-2">
        <BaseTextarea
          v-model="form.description"
          name="description"
          :label="$trans('master.city.props.description')"
          v-model:error="formErrors.description"
        />
      </div>
      <div class="grid grid-cols-1">
        <div class="col">
          <MediaUpload
            multiple
            :label="$trans('general.file')"
            module="project"
            :media="form.media"
            @setHash="(hash) => (form.mediaHash = hash)"
            @setToken="(token) => (form.mediaToken = token)"
          />
        </div>
      </div>
    </div>
  </FormAction>
</template>

<script>
export default {
  name: "CityForm",
};
</script>

<script setup>
import { reactive } from "vue";
import { getFormErrors } from "@core/helpers/action";

const initUrl = "master/city/";
const formErrors = getFormErrors(initUrl);
const preRequisites = reactive({});

const initForm = {
  title: "",
  category: "",
  media: [],
  mediaToken: "",
  mediaHash: "",
};

const form = reactive({ ...initForm });
const setPreRequisites = (data) => {
  Object.assign(preRequisites, data);
};
</script>
