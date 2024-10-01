<template>
  <TransitionRoot as="template" :show="visibility">
    <div class="fixed inset-0 overflow-hidden z-20" @close="emit('close')">
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0" />

        <div class="fixed inset-y-0 pl-16 lg:max-w-1/2 max-w-3/4 right-0 flex">
          <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
            <div class="w-screen">
              <div class="h-full divide-y divide-gray-200 dark:divide-gray-700 flex flex-col bg-white dark:bg-dark-body shadow-xl">
                <div class="flex-1 h-0 overflow-y-auto">
                  <div class="mt-16 py-6 px-4 bg-primary dark:bg-black sm:px-6">
                    <div class="flex items-center justify-between">
                      <div class="text-lg font-medium text-white">
                        <slot name="title"></slot>
                      </div>
                      <div class="ml-3 h-7 flex items-center">
                        <span class="text-gray-200 cursor-pointer hover:text-white" @click="emit('close')">
                          <span class="sr-only">Close panel</span>
                          <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                        </span>
                      </div>
                    </div>
                    <div class="mt-1" v-if="$slots.description">
                      <p class="text-sm text-indigo-300">
                        <slot name="description"></slot>
                      </p>
                    </div>
                  </div>
                  <div class="flex-1 flex flex-col justify-between p-4  overflow-x-hidden scroller-thin-y scroller-hidden">
                      <slot></slot>
                  </div>
                </div>
                <div class="shrink-0 px-4 py-4 flex justify-end">
                </div>
              </div>
            </div>
          </TransitionChild>
        </div>
      </div>
    </div>
  </TransitionRoot>
</template>

<script setup>
import { ref, useSlots } from 'vue'
import { TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'

const slots = useSlots()

const emit = defineEmits(["close"]);

const props = defineProps({
    visibility: {
        type: Boolean,
        default: false,
    },
});
</script>
