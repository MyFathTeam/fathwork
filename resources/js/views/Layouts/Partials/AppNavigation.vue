<template>
    <template v-for="navGroup in navigations">
        <div class="space-y-0">
            <h3 v-if="navGroup.meta.label" v-show="showMenuName" class="flex px-5 py-3 text-white uppercase">
                <span>{{$trans(navGroup.meta.label)}}</span>
                <!-- <span :class="['badge', 'badge-red', 'mr-2']" v-show="navigation.badgeLabel && showMenuName">
                    {{navigation.badgeLabel}}
                </span> -->
            </h3>
            <ul class="text-sm">
                <li class="text-secondary hover:text-dark-secondary hover:bg-dark-primary dark:hover:bg-dark-body"
                    v-for="navigation in navGroup.children"
                    :key="navigation.name"
                    :class="{
                        'bg-dark-primary dark:bg-dark-body': isActive(navigation)
                    }"
                >
                    <template v-if="visibleMenu(navigation)">
                        <component
                            :is="isLink(navigation) ? 'router-link' : 'div'"
                            :to="isLink(navigation) ? {name: navigation.name} : ''"
                            class="cursor-pointer"
                            @click="menuClick(navigation)"
                        >
                            <div class="pl-6 pr-2 py-3 flex" :class="{'justify-between': hasChild(navigation)}">
                                <div>
                                    <span>
                                        <i class="mr-3 shrink-0 w-6" :class="navigation.meta.icon"></i>
                                    </span>
                                    <span v-show="showMenuName">{{$trans(navigation.meta.label)}}</span>
                                </div>
                                <span v-if="hasChild(navigation) && showMenuName">
                                    <i class="mr-3 shrink-0 w-6 fas fa-chevron-right" v-if="state.openedMenu != navigation.name"></i>
                                    <i class="mr-3 shrink-0 w-6 fas fa-chevron-down" v-else></i>
                                </span>
                            </div>
                        </component>

                        <MenuParentTransition direction="down" :show="hasChild(navigation) && state.openedMenu == navigation.name">
                            <ul :class="{}" v-show="showMenuName">
                                <li class="text-secondary hover:text-darken-secondary hover:bg-darken-primary dark:hover:bg-black cursor-pointer"
                                :class="{
                                    'bg-darken-primary dark:bg-dark-body': isActive(children)
                                }" :key="children.name" v-for="children in navigation.children">
                                    <router-link :to="{name: children.name}">
                                        <div class="px-8 py-2 flex">
                                            <span>
                                                <i class="mr-3 w-5" :class="children.meta.icon || menu.defaultChildrenIcon"></i>
                                            </span>
                                            <span>{{$trans(children.meta.label)}}</span>
                                        </div>
                                    </router-link>
                                </li>
                            </ul>
                        </MenuParentTransition>
                    </template>
                </li>
            </ul>
        </div>
    </template>
</template>

<script>
export default {
    name: 'AppSidebar'
}
</script>

<script setup>
import { computed, reactive, watch } from "vue"
import { useStore } from "vuex"
import { useRoute, useRouter } from "vue-router"

const store = useStore()
const route = useRoute()
const router = useRouter()

const props = defineProps({
    mobile: {
        type: Boolean,
        deafult: false
    }
})

const state = reactive({
    openedMenu: '',
    activeMenu: route.name,
    activeSubMenu: ''
})

const sidebarType = computed(() => store.getters['layout/getSidebarType'])
const navigations = computed(() => store.getters['navigation/navigations'])
const isFullSidebar = computed(() => sidebarType.value === 'full')
const isPinnedSidebar = computed(() => sidebarType.value === 'pinned')
const showMenuName = computed(() => props.mobile || isFullSidebar.value || isPinnedSidebar.value)

const sidebarMouseOver = () => {
    if (! isPinnedSidebar.value) {
        store.dispatch('layout/setSidebarType', 'full')
    }
}

const sidebarMouseLeave = () => {
    if (! isPinnedSidebar.value) {
        store.dispatch('layout/setSidebarType', 'mini')
    }
}

const visibleMenu = (menu) => {
    if (menu.meta.isHiddenNav) {
        return false
    }

    if (! menu.hasOwnProperty('children')) {
        return true
    }

    if (menu.children.length === 0) {
        return false
    }

    return true
}

const hasChild = (menu) => {
    if (! menu.hasOwnProperty('children')) {
        return false;
    }

    return menu.children.length > 0 && ! menu.meta.hideChildren
}

const isLink = (navigation) => {
    return hasChild(navigation) ? false : true
}

const menuClick = (navigation) => {
    if (hasChild(navigation)) {
        if (state.openedMenu == navigation.name) {
            state.openedMenu = ''
        } else {
            state.openedMenu = navigation.name
        }
    } else {
        // router.push({name: navigation.name})
    }
}

const subMenuClick = (children) => {
    // router.push({name: children.name})
}

const isActive = (navigation) => {
    let redirectMenu = navigation.redirect && navigation.redirect.name ? navigation.redirect.name : ''
    let hasChildren = navigation.children && navigation.children.length ? true : false

    if (hasChildren && navigation.children.some(children => isActive(children))) {
        return true
    }

    return (state.activeMenu === navigation.name) || (redirectMenu && state.activeMenu === redirectMenu)
}

watch(
    () => route.name,
    (newValue) => {
        state.activeMenu = newValue
    }
)
</script>
