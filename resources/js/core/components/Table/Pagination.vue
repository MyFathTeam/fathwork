<template>
  <div class="bg-white dark:bg-neutral-700 px-2 py-3 flex items-center justify-between border-t sm:rounded-bl-lg sm:rounded-br-lg border-gray-200 dark:border-gray-700" v-if="meta.from && meta.to">
    <div class="flex-1 flex justify-between sm:hidden text-gray-700 dark:text-gray-400" v-if="meta.lastPage >= 1">
        <div>
            <span v-if="currentPage <= 1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md bg-gray-200 dark:bg-dark-body">
                {{$trans('pagination.previous')}}
            </span>
            <a v-else @click="updateCurrentPage(currentPage - 1)" href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md bg-white dark:bg-dark-body hover:bg-gray-50">
                {{$trans('pagination.previous')}}
            </a>
        </div>
        <div>
            <span v-if="currentPage >= meta.lastPage" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md bg-gray-200 dark:bg-dark-body">
                {{$trans('pagination.next')}}
            </span>
            <a v-else @click="updateCurrentPage(+currentPage + 1)" href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md bg-white dark:bg-dark-body hover:bg-gray-50">
                {{$trans('pagination.next')}}
            </a>
        </div>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between text-gray-700 dark:text-gray-400">
      <div>
        <p class="text-sm" v-if="meta.from && meta.to">
            {{$trans('pagination.showing_result', {from: meta.from, to: meta.to, total: meta.total})}}
        </p>
      </div>
      <div class="flex items-center justify-between space-x-4">
        <DropdownButton direction="up" v-if="paginations.length && ! cardView" :label="$trans('pagination.list_per_page', {attribute: perPage})">
            <div v-for="pagination in paginations" :key="pagination">
                <template v-if="pagination != perPage">
                    <DropdownItem as="span" @click="updatePerPage(pagination)">
                        {{$trans('pagination.list_per_page', {attribute: pagination})}}
                    </DropdownItem>
                </template>
            </div>
        </DropdownButton>

        <div v-if="meta.lastPage >= 1">
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
            <span v-if="currentPage <= 1" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-dark-header text-sm font-medium text-gray-500">
                <span class="sr-only">{{$trans('pagination.previous')}}</span>
                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
            </span>
            <a v-else @click="updateCurrentPage(currentPage - 1)" href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-dark-header text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">{{$trans('pagination.previous')}}</span>
                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
            </a>
            <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white dark:bg-dark-header border-gray-300 dark:border-gray-700 text-gray-500 hover:bg-gray-50" -->
            <template v-for="(page, key) in pageRange">
                <a href="#" v-if="page != '...'" @click="updateCurrentPage(page)" aria-current="page"
                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                    :class="{
                        'z-10 bg-primary dark:bg-dark-body border-primary dark:border-gray-700 text-secondary': page == currentPage,
                        'bg-white dark:bg-dark-header border-gray-300 dark:border-gray-700 text-gray-500 hover:bg-gray-50 dark:hover:bg-dark-body': page != currentPage
                    }"
                >
                    {{page}}
                </a>
                <span v-else aria-current="page"
                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium bg-white dark:bg-dark-header border-gray-300 dark:border-gray-700 text-gray-500 hover:bg-gray-50">
                    {{page}}
                </span>
            </template>
            <span v-if="currentPage >= meta.lastPage" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-dark-header text-sm font-medium text-gray-500">
                <span class="sr-only">{{$trans('pagination.next')}}</span>
                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
            </span>
            <a v-else @click="updateCurrentPage(+currentPage + 1)" href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-dark-header text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">{{$trans('pagination.next')}}</span>
                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
            </a>
            </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useStore } from "vuex"
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid'

const route = useRoute()
const router = useRouter()
const store = useStore()

const emit = defineEmits(['refresh'])

const props = defineProps({
    meta: {
        type: Object,
        default: {}
    },
    limit: {
        type: Number,
        default: 1
    },
    cardView: {
        type: Boolean,
        default: false
    }
})

const paginations = computed(() => store.getters['config/config']('system.paginations') ?? [])
const defaultPerPage = computed(() => store.getters['config/config']('system.perPage') ?? [])
const currentPage = computed(() => route.query.currentPage ?? 1)
const perPage = computed(() => route.query.perPage ?? defaultPerPage.value)

const pageRange = computed(() => {
    if (props.limit === -1) {
        return 0;
    }
    if (props.limit === 0) {
        return props.meta.lastPage;
    }
    var current = currentPage.value;
    var last = props.meta.lastPage;
    var delta = props.limit;
    var left = current - delta;
    var right = Number(current) + Number(delta) + 1;
    var range = [];
    var pages = [];
    var l;
    for (var i = 1; i <= last; i++) {
        if (i === 1 || i === last || (i >= left && i < right)) {
            range.push(i);
        }
    }
    range.forEach(function (i) {
        if (l) {
            if (i - l === 2) {
                pages.push(l + 1);
            } else if (i - l !== 1) {
                pages.push('...');
            }
        }
        pages.push(i);
        l = i;
    });
    return pages;
})

const updateCurrentPage = (page) => {
    if (page === '...') {
        return
    }

    if (page > props.meta.lastPage) {
        return
    }

    if (page < 1) {
        return
    }

    updateURL({currentPage: page})
}

const updatePerPage = (limit) => {
    updateURL({perPage: limit, currentPage: 1})
}

const updateURL = async (query) => {
    await router.push({
        name: route.name,
        query: {
          ...route.query,
          ...query
        },
    })

    emit('refresh')
}
</script>
