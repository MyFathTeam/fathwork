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
                w-8
                h-8
                bg-white
                inline-flex
                items-center
                justify-center
                text-gray-400
                rounded-full
                hover:text-gray-500
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-purple-500
            "
        >
            <span class="sr-only"
                >Open options</span
            >
            <EllipsisVerticalIcon
                class="w-5 h-5"
                aria-hidden="true"
            />
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
                    right-7
                    top-0
                    w-48
                    mt-1
                    rounded-md
                    shadow-lg
                    z-10
                    bg-white
                    ring-1 ring-black ring-opacity-5
                    divide-y divide-gray-200
                    focus:outline-none
                "
            >
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <a
                            href="#"
                            :class="[
                                active
                                    ? 'bg-gray-100 text-gray-900'
                                    : 'text-gray-700',
                                'group flex items-center px-4 py-2 text-sm',
                            ]"
                        >
                            <PencilSquareIcon
                                class="
                                    mr-3
                                    h-5
                                    w-5
                                    text-gray-400
                                    group-hover:text-gray-500
                                "
                                aria-hidden="true"
                            />
                            Edit
                        </a>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <a
                            href="#"
                            :class="[
                                active
                                    ? 'bg-gray-100 text-gray-900'
                                    : 'text-gray-700',
                                'group flex items-center px-4 py-2 text-sm',
                            ]"
                        >
                            <Square2StackIcon
                                class="
                                    mr-3
                                    h-5
                                    w-5
                                    text-gray-400
                                    group-hover:text-gray-500
                                "
                                aria-hidden="true"
                            />
                            Duplicate
                        </a>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <a
                            href="#"
                            :class="[
                                active
                                    ? 'bg-gray-100 text-gray-900'
                                    : 'text-gray-700',
                                'group flex items-center px-4 py-2 text-sm',
                            ]"
                        >
                            <UserPlusIcon
                                class="
                                    mr-3
                                    h-5
                                    w-5
                                    text-gray-400
                                    group-hover:text-gray-500
                                "
                                aria-hidden="true"
                            />
                            Share
                        </a>
                    </MenuItem>
                </div>
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <a
                            href="#"
                            :class="[
                                active
                                    ? 'bg-gray-100 text-gray-900'
                                    : 'text-gray-700',
                                'group flex items-center px-4 py-2 text-sm',
                            ]"
                        >
                            <TrashIcon
                                class="
                                    mr-3
                                    h-5
                                    w-5
                                    text-gray-400
                                    group-hover:text-gray-500
                                "
                                aria-hidden="true"
                            />
                            Delete
                        </a>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script>
export default {
    name: 'RowAction'
}
</script>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { Bars3Icon } from "@heroicons/vue/20/solid";
import {
    ChevronRightIcon,
    EllipsisVerticalIcon,
    Square2StackIcon,
    PencilSquareIcon,
    TrashIcon,
    UserPlusIcon,
} from "@heroicons/vue/20/solid";

</script>
