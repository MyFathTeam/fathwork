<template>
    <component :is="as"
        type="button"
        class="
            relative
            inline-flex
            items-center justify-start overflow-hidden
            font-medium
            z-0
            transition-all duration-300
            after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-full after:h-full after:-z-20
            before:content-[''] before:absolute before:bottom-0 before:left-0 before:w-0 before:h-full before:-z-10
            before:transition-all before:duration-300 hover:before:w-full
        "
        :class="
            {
                'cursor-not-allowed': disabled,
                'focus:outline-none focus:ring-2 focus:ring-offset-2': focusRing,
                'border border-transparent': design !== 'white' && design !== 'secondary',
                'w-full flex justify-center': block === true,
                'inline-flex items-center': block === false,
                'px-2.5 py-1.5 text-xs': size === 'xs',
                'px-3 py-2 text-sm leading-4': size === 'sm',
                'px-4 py-2 text-sm': size === 'md',
                'px-4 py-2 text-base': size === 'lg',
                'px-6 py-3 text-base': size === 'xl',
                'rounded-xl': ! roundedFull,
                'rounded-full': roundedFull,
                'after:bg-white before:bg-gray-100 dark:after:bg-dark-header dark:before:bg-neutral-700 text-gray-600 dark:text-gray-400 focus:ring-white' : design === 'white',
                'after:bg-primary before:bg-dark-primary dark:after:bg-gray-700 dark:before:bg-gray-500 text-secondary dark:text-gray-200 focus:ring-primary dark:focus:ring-dark-header' : design === 'primary',
                'after:bg-secondary before:bg-dark-secondary dark:after:bg-dark-body dark:before:bg-neutral-700 text-primary dark:text-gray-400 focus:ring-secondary dark:focus:ring-dark-body' : design === 'secondary',
                'after:bg-success before:bg-dark-success text-secondary focus:ring-success' : design === 'success',
                'after:bg-[#3b5998] before:bg-[#1f4494] text-white focus:ring-[#3b5998]' : design === 'facebook',
                'after:bg-info before:bg-dark-info text-secondary focus:ring-info' : design === 'info',
                'after:bg-warning before:bg-dark-warning text-secondary focus:ring-warning' : design === 'warning',
                'after:bg-danger before:bg-dark-danger text-secondary focus:ring-danger' : (design === 'danger' || design === 'error'),
            }
        "
    >
        <slot></slot>
    </component>
</template>

<script>
export default {
    name: 'BaseButton'
}
</script>

<script setup>
const props = defineProps({
    as: {
        type: String,
        default: 'button'
    },
    size: {
        type: String,
        validator(value) {
            return ["xs", "sm", "md", "lg", "xl"].includes(value)
        },
        default: 'md'
    },
    roundedFull: Boolean,
    focusRing: Boolean,
    block: Boolean,
    design: {
        type: String,
        validator(value) {
            return ["primary", "secondary", "info", "success", "warning", "danger", "error", "white", "facebook"].includes(value)
        },
        default: 'primary'
    },
    disabled: {
        type: Boolean,
        default: false
    }
})
</script>
