<template>
  <FormAction
    :init-url="initUrl"
    :pre-requisites="true"
    @setPreRequisites="setPreRequisites"
    :init-form="initForm"
    :form="form"
    redirect="Post"
  >
    <div class="grid grid-cols-2 gap-6">
      <div class="col-span-2">
        <BaseInput
          type="text"
          v-model="form.name"
          name="name"
          :label="$trans('blog.post.props.name')"
          v-model:error="formErrors.name"
          autofocus
        />
      </div>
      <div class="col-span-2">
        <BaseSelect
          v-model="form.postcategory"
          name="postcategory"
          :label="$trans('blog.postcategory.postcategory')"
          :options="preRequisites.postcategory"
          v-model:error="formErrors.postcategory"
        />
      </div>
      <div class="col-span-3 sm:col-span-2">
        <BaseTextarea
          v-model="form.description"
          name="description"
          :label="$trans('blog.post.props.description')"
          v-model:error="formErrors.description"
        />
      </div>
    </div>
    <div class="grid grid-cols-1">
      <div class="col">
        <MediaUpload
          multiple
          :label="$trans('general.file')"
          module="post"
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
  name: "PostForm",
};
</script>

<script setup>
import { reactive } from "vue";
import { getFormErrors } from "@core/helpers/action";

const initUrl = "blog/post/";
const formErrors = getFormErrors(initUrl);
const preRequisites = reactive({});

const initForm = {
  name: "",
  postcategory: "",
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
