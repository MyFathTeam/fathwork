<template>
    <PageHeader
        :title="
            $trans(route.meta.label)
        "
        :navs="[{ label: $trans('config.config'), path: 'Config' }]"
    >
        <slot name="action"></slot>
    </PageHeader>
    <ParentTransition appear :visibility="true">
        <div class="w-full mx-auto pb-6 lg:pb-16">
            <div class="">
                <div
                    class="
                        divide-y divide-gray-200 dark:divide-gray-700 space-x-2
                        sm:grid sm:grid-cols-12 sm:divide-y-0 sm:divide-x
                    "
                >
                    <ConfigSidebar />

                    <div class="sm:col-span-9 lg:col-span-10"
                        :class="{
                            'p-4 bg-white dark:bg-dark-header rounded-lg': ! noBackground
                        }"
                    >
                        <ChildTransition appear :visibility="true" direction="ltr">
                            <slot></slot>
                        </ChildTransition>
                    </div>
                </div>
            </div>
        </div>
    </ParentTransition>
</template>

<script>
export default {
    name: 'ConfigPage'
}
</script>

<script setup>
import { useRoute } from "vue-router";

const route = useRoute()

const props = defineProps({
    noBackground: {
        type: Boolean,
        default: false
    }
})
</script>