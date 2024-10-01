<template>
    <div :class="{
        'py-1': separator
    }">
        <component :is="getComponent"
            :href="href"
            :target="$attrs.target"
            class="group flex items-center px-4 py-2 text-sm"
            :class="{
                'bg-gray-100 text-gray-900 dark:bg-dark-body dark:text-gray-400': active,
                'text-gray-700 dark:text-gray-300': ! active,
                'cursor-pointer': as === 'span'
            }"
        >
            <i v-if="icon"
                :class="icon"
                class="
                    mr-3
                    text-gray-400
                    group-hover:text-gray-500
                "
                aria-hidden="true"
            ></i>
            <slot></slot>
        </component>
    </div>
</template>

<script>
export default {
    name: 'FloatingMenuItem'
}
</script>

<script setup>
import { computed } from "vue"
import { useRouter } from "vue-router"
import { MenuItem } from "@headlessui/vue";

const props = defineProps({
    separator: {
        type: Boolean,
        default: false
    },
    icon: {
        type: String,
        default: ''
    },
    as: {
        type: String,
        default: 'span' // span|link|route
    },
    href: {
        type: String,
        default: '#'
    },
    disabled: {
        type: Boolean,
        default: false
    },
    active: {
        type: Boolean,
        default: false
    }
})

const getComponent = computed(() => {
    if (props.as === 'route') {
        return 'router-link'
    } else if (props.as === 'link') {
        return 'a'
    } else {
        return 'span'
    }
})
</script>
