<template>
    <Menu
        as="div"
        class="
            relative
            flex
            justify-end
            items-center
        "
    >
        <MenuButton
            class="
                bg-transparent
                dark:bg-dark-header
                inline-flex
                items-center
                justify-center
                text-gray-400
                rounded-full
                hover:text-gray-500
            "

            :class="{
                'h-5 w-5': slim,
                'h-8': ! slim,
                'w-8': ! noWidth,
            }"
        >
            <span class="sr-only"
                >Open options</span
            >
            <slot name="clickable">
                <EllipsisVerticalIcon
                    class="w-5 h-5"
                    aria-hidden="true"
                />
            </slot>
        </MenuButton>
        <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <MenuItems
                class="
                    mx-3
                    origin-top-right
                    absolute
                    w-48
                    mt-1
                    rounded-md
                    shadow-lg
                    z-20
                    bg-white
                  dark:bg-dark-header
                    dark:border
                    dark:border-gray-700
                    ring-1 ring-black ring-opacity-5
                    divide-y divide-gray-200 dark:divide-gray-600
                    focus:outline-none
                    overflow-hidden
                "
                :class="{
                    'top-0': ! topMargin && ! doubleTopMargin,
                    'top-6': topMargin,
                    'top-10': doubleTopMargin,
                    'right-7': rightMargin,
                    'right-0': ! rightMargin
                }"
            >
                <slot></slot>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script>
export default {
    name: 'DropdownMenu'
}
</script>

<script setup>
import { Menu, MenuButton, MenuItems } from "@headlessui/vue";
import { Bars3Icon } from "@heroicons/vue/20/solid";

const props = defineProps({
    slim: {
        type: Boolean,
        default: false
    },
    noWidth: {
        type: Boolean,
        default: false
    },
    topMargin: {
        type: Boolean,
        default: false
    },
    doubleTopMargin: {
        type: Boolean,
        default: false
    },
    rightMargin: {
        type: Boolean,
        default: true
    }
})
</script>
