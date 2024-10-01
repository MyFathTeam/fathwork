<template>
  <div
    class="grid gap-2"
    :class="{
      'grid-cols-4': grid === 4,
      'grid-cols-3': grid === 3,
      'grid-cols-2': grid === 2,
      'grid-cols-1': grid === 1,
    }"
  >
    <div
      v-for="item in media"
      @click="download(item.uuid)"
      class="sm:col-span-1"
      :class="{
        'col-span-4': grid === 4,
        'col-span-3': grid === 3,
        'col-span-2': grid === 2,
        'col-span-1': grid === 1,
      }"
    >
      <div class="flex justify-between items-start">
        <div class="flex cursor-pointer">
          <span class="mr-4"
            ><i class="fas text-4xl" :class="item.icon"></i>
          </span>
          <div class="flex flex-col">
            <span>{{ item.name }}</span>
            <span>{{ item.size }}</span>
          </div>
        </div>
        <div>
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
  <BaseAlert v-if="media.length === 0" design="info" size="xs">{{
    $trans("general.errors.attachment_not_found")
  }}</BaseAlert>
</template>

<script>
export default {
  name: "ListMedia",
};
</script>

<script setup>
import { computed } from "vue";
import { useStore } from "vuex";

const store = useStore();

const props = defineProps({
  media: {
    type: Array,
    default: [],
  },
  url: {
    type: String,
    default: "/",
  },
  grid: {
    type: Number,
    default: 4,
  },
});

const appUrl = computed(() => store.getters["config/config"]("system.url"));

const download = (uuid) => {
  window.open(appUrl.value + props.url + "public/" + uuid);
};
</script>
