<template>
  <Popover class="relative" v-slot="{ open }">
    <PopoverButton class="text-white inline-flex items-center text-base font-medium">
      <span>
          {{ label }}
      </span>
      <ChevronDownIcon :class="['text-white', 'ml-1 h-5 w-5']" aria-hidden="true" />
    </PopoverButton>

    <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
      <PopoverPanel class="absolute z-10 right-0 transform mt-3 px-2 w-48 max-w-xs sm:px-0">
        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
          <div class="relative grid gap-4 bg-white px-5 py-2 sm:gap-4 sm:p-2">
            <slot></slot>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>

<script>
export default {
    name: 'FlyoutMenu'
}
</script>

<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
    label: {
        type: String,
        default: ''
    }
})
</script>
