<template>
  <span class="relative z-10 inline-flex shadow-sm rounded-md">
    <span v-if="as === 'span'" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-r-0 border-gray-300 dark:border-gray-700 bg-white dark:bg-dark-header text-sm truncate font-medium text-gray-700 dark:text-gray-400 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-0">
      {{label}}
    </span>
    <button type="button" v-if="as === 'button'" class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-r-0 border-gray-300 dark:border-gray-700 bg-white dark:bg-dark-header text-sm truncate font-medium text-gray-700 dark:text-gray-400 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-0">
      {{label}}
    </button>
    <Menu as="span" class="-ml-px relative block">
      <MenuButton class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-l-0 border-gray-300 dark:border-gray-700 bg-white dark:bg-dark-header text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-0">
        <span class="sr-only">Open options</span>
        <ChevronUpIcon v-if="direction === 'up'" class="h-5 w-5" aria-hidden="true" />
        <ChevronDownIcon v-if="direction === 'down'" class="h-5 w-5" aria-hidden="true" />
      </MenuButton>
      <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
        <MenuItems
            class="absolute right-0 mt-2 -mr-1 w-56 rounded-md shadow-lg bg-white dark:bg-dark-header ring-1 ring-black ring-opacity-5 focus:outline-none"
            :class="{
                'origin-bottom-right bottom-10': direction === 'up',
                'origin-top-right': direction === 'down'
            }"
        >
        <slot></slot>
        </MenuItems>
      </transition>
    </Menu>
  </span>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronUpIcon, ChevronDownIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
    direction: {
        type: String,
        default: 'down'
    },
    label: {
        type: String,
        default: ''
    },
    as: {
        type: String,
        default: 'span' // span|button
    }
})

const items = [
  { name: 'Save and schedule', href: '#' },
  { name: 'Save and publish', href: '#' },
  { name: 'Export PDF', href: '#' },
]
</script>
