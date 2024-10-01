<template>
    <PageHeader
        :title="
            $trans(route.meta.label)
        "
        :navs="[{ label: $trans('user.user'), path: 'User' }]"
    />
    <ParentTransition appear :visibility="true">
        <article>
            <div class="bg-black rounded-t-lg overflow-hidden">
                <div class="max-w-full mx-auto pb-4 px-4 sm:px-6 lg:px-8">
                    <div class="mt-8 sm:flex sm:items-end sm:space-x-5">
                        <div class="flex items-center space-x-4">
                            <img class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32" :src="getAvatar" alt="" />
                            <div class="mt-16">
                                <h1 class="text-2xl font-bold text-secondary truncate">
                                    {{ getName }}
                                </h1>
                                <span class="text-md text-light-secondary">{{ getEmail }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-black pt-6 sm:pt-2 2xl:pt-5">
                <div class="border-b border-gray-200 dark:border-gray-700">
                <div class="px-4 sm:px-6 lg:px-8">
                    <nav class="-mb-px flex flex-wrap" aria-label="Tabs">
                    <router-link v-for="tab in tabs" :key="tab.name" :to="{name: tab.path}" :class="[route.name === tab.path ? 'bg-white dark:bg-dark-header rounded-t-lg dark:border dark:border-b-0 dark:border-gray-700 text-black dark:text-gray-400' : 'border-transparent text-white dark:text-gray-400 hover:text-secondary dark:hover:text-gray-500 hover:border-gray-300 dark:hover:border-gray-700', 'whitespace-nowrap py-2 px-4 font-medium text-sm text-gray-500']" :aria-current="tab.current ? 'page' : undefined">
                        {{ tab.name }}
                    </router-link>
                    </nav>
                </div>
                </div>
            </div>

            <div class="flex bg-white dark:bg-dark-header sm:rounded-bl-lg sm:rounded-br-lg">
                <div class="hidden md:block py-6 w-1/3 mx-auto px-4 sm:px-6 lg:px-8 border-r border-gray-200 dark:border-gray-700">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                            {{ $trans('user.profile.props.name') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-400 truncate">
                            {{ getName }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                            {{ $trans('user.profile.props.email') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-400 truncate">
                            {{ getEmail }}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                            {{ $trans('user.profile.props.username') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-400 truncate">
                            {{ getUsername }}
                            </dd>
                        </div>
                    </dl>
                </div>
                <div class="py-6 w-full md:w-2/3 mx-auto px-4 sm:px-6 lg:px-8">
                    <router-view />
                </div>
            </div>
        </article>
    </ParentTransition>
</template>

<script>
export default {

}
</script>

<script setup>
import { inject, computed } from "vue"
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import { EnvelopeIcon, PhoneIcon } from '@heroicons/vue/20/solid'

const route = useRoute()
const store = useStore()

const getAvatar = computed(() => store.getters["auth/user/user"]('avatar'))
const getName = computed(() => store.getters["auth/user/user"]('profile.name'))
const getEmail = computed(() => store.getters["auth/user/user"]('email'))
const getUsername = computed(() => store.getters["auth/user/user"]('username'))

const $trans = inject("$trans")

const tabs = [
  { name: $trans('user.profile.profile'), path: 'UserProfile' },
  { name: $trans('user.profile.account'), path: 'UserAccount' },
  { name: $trans('user.avatar'), path: 'UserAvatar' },
  { name: $trans('user.preference.preference'), path: 'UserPreference' },
  { name: $trans('auth.password.change_password'), path: 'UserPassword' },
]
</script>
