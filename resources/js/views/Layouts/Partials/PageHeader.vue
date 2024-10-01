<template>
    <ParentTransition appear direction="ltr" :visibility="true">
        <div class="px-4 sm:px-6 lg:px-0">
            <div v-if="! noBreadcrumb">
                <nav class="sm:hidden" aria-label="Back">
                    <a href="#" @click="router.go(-1)" class="flex items-center text-sm font-medium text-gray-400 hover:text-gray-200">
                        <div>
                            <i class="fas fa-chevron-left shrink-0 -ml-1 mr-1 h-5 w-5 text-gray-500" aria-hidden="true"></i>
                            {{$trans('general.back')}}
                        </div>
                    </a>
                </nav>
                <nav class="hidden sm:flex" aria-label="Breadcrumb">
                    <ol role="list" class="flex items-center space-x-4">
                    <li>
                        <div class="flex">
                            <router-link :to="{name: 'Dashboard'}" class="text-sm font-medium text-gray-400 hover:text-gray-600">
                                <i class="fas fa-home mr-2"></i> {{$trans('dashboard.dashboard')}}
                            </router-link>
                        </div>
                    </li>
                    <li v-for="nav in navs">
                        <div class="flex items-center">
                        <i class="fas fa-chevron-right fa-sm shrink-0 w-5 mr-2 text-gray-500" aria-hidden="true"></i>
                        <router-link :to="generatePath(nav)" class="text-sm font-medium text-gray-400 hover:text-gray-600">{{nav.label}}</router-link>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                        <i class="fas fa-chevron-right fa-sm shrink-0 w-5 mr-2 text-gray-500" aria-hidden="true"></i>
                        <span aria-current="page" class="text-sm font-medium text-gray-400">{{title}}</span>
                        </div>
                    </li>
                    </ol>
                </nav>
            </div>
            <div class="mt-2 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0 dark:text-gray-400">
                <h2 class="text-xl font-bold leading-7 sm:text-2xl sm:truncate">
                {{title}}
                </h2>
                <h6 v-if="subTitle">{{subTitle}}</h6>
            </div>
            <div class="mt-4 shrink-0 flex md:mt-0 md:ml-4">
                <slot></slot>
            </div>
            </div>
        </div>
    </ParentTransition>
</template>

<script>
export default {
    name: 'PageHeader'
}
</script>

<script setup>
import { useRouter } from "vue-router"

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    subTitle: {
        type: String,
        default: ''
    },
    navs: {
        type: Array,
        default: []
    },
    noBreadcrumb: {
        type: Boolean,
        default: false
    }
})

const router = useRouter()

const generatePath = (nav) => {
    if (typeof nav.path === 'string') {
        return {name: nav.path}
    }

    return nav.path
}
</script>