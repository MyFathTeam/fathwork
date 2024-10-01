<template>
  <PageHeader
    :title="
      $trans(route.meta.trans, {
        attribute: $trans(route.meta.label),
      })
    "
    :navs="[{ label: $trans('blog.post.post'), path: 'PostList' }]"
  >
    <PageHeaderAction
      name="Post"
      :title="$trans('blog.post.post')"
      :actions="['list']"
    />
  </PageHeader>

  <ParentTransition appear :visibility="true">
    <ShowItem
      :init-url="initUrl"
      :uuid="route.params.uuid"
      @setItem="setItem"
      @redirectTo="router.push({ name: 'Post' })"
    >
      <BaseCard v-if="post.uuid">
        <template #name>
          {{ post.name }}
        </template>
        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
          <BaseDataView :label="$trans('blog.post.props.description')">
            <div v-html="post.description"></div>
          </BaseDataView>
          <BaseDataView
            :label="$trans('blog.postcategory.postcategory')"
          >
            <div v-html="post.postcategorytitle"></div>
          </BaseDataView>

          <BaseDataView class="col-span-1 sm:col-span-2">
            <ListMedia
              :media="post.media"
              :url="`/app/blog/posts/${post.uuid}/`"
            />
          </BaseDataView>

          <BaseDataView :label="$trans('general.created_at')">
            {{ post.createdAt }}
          </BaseDataView>

          <BaseDataView :label="$trans('general.updated_at')">
            {{ post.updatedAt }}
          </BaseDataView>
        </dl>
        <template #footer>
          <ShowButton>
            <BaseButton
              design="primary"
              @click="
                router.push({
                  name: 'PostEdit',
                  params: { uuid: post.uuid },
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
  name: "PostShow",
};
</script>

<script setup>
import { reactive } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const initialPost = {};

const initUrl = "blog/post/";

const post = reactive({ ...initialPost });

const setItem = (data) => {
  Object.assign(post, data);
};
</script>
