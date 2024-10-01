<template>
    <ParentTransition appear :visibility="true">
        <div class="w-full mx-auto pb-6 lg:pb-16">
            <div
                class="
                    sm:space-x-4 space-y-4 sm:space-y-0
                    sm:grid sm:grid-cols-12
                "
            >

                <aside class="bg-black rounded-lg py-3 sm:col-span-3 lg:col-span-2" v-if="navigations.length > 1">
                    <slot name="header"></slot>
                    <ModuleConfigSidebar :navigations="navigations" use-uuid />
                </aside>

                <div :class="{
                    'sm:col-span-9 lg:col-span-10': navigations.length > 1,
                    'col-span-12': navigations.length === 1
                }">
                    <ChildTransition appear :visibility="true" direction="ltr">
                        <div class="space-y-4">
                            <slot></slot>
                        </div>
                    </ChildTransition>
                </div>
            </div>
        </div>
    </ParentTransition>
</template>

<script>
export default {
    name: 'ModuleConfig'
}
</script>

<script setup>
const props = defineProps({
    navigations: {
        type: Array,
        default: []
    },
    useUuid: {
        type: Boolean,
        default: false
    }
})
</script>
