<template>
    <ParentTransition appear :visibility="true">
        <div class="py-4">
            <slot name="header"></slot>
        </div>
        <div>
            <nav class="mx-auto" aria-label="Progress">
                <ol
                    role="list"
                    class="
                        rounded-md
                        overflow-hidden
                        lg:flex lg:border-dark-secondary lg:rounded-none
                    "
                >
                    <li
                        v-for="(tab, index) in state.tabs"
                        :key="index"
                        @click="selectTab(index)"
                        class="relative overflow-hidden lg:flex-1 cursor-pointer"
                    >
                        <div
                            :class="[
                                index === 0 ? 'rounded-t-md' : '',
                                index === state.tabs.length - 1
                                    ? 'rounded-b-md'
                                    : '',
                                'border-dark-secondary overflow-hidden',
                            ]"
                        >
                            <a v-if="index < state.selectedIndex" class="group">
                                <span
                                    class="
                                        absolute
                                        top-0
                                        left-0
                                        w-1
                                        h-full
                                        bg-transparent
                                        group-hover:bg-dark-secondary
                                        lg:w-full lg:h-1 lg:bottom-0 lg:top-auto
                                    "
                                    aria-hidden="true"
                                />
                                <span
                                    :class="[
                                        index !== 0 ? 'lg:pl-9' : '',
                                        'px-6 py-5 flex items-start text-sm font-medium',
                                    ]"
                                >
                                    <span class="shrink-0">
                                        <span
                                            class="
                                                w-10
                                                h-10
                                                flex
                                                items-center
                                                justify-center
                                                bg-primary
                                            "
                                        >
                                            <CheckIcon
                                                class="w-6 h-6 text-white"
                                                aria-hidden="true"
                                            />
                                        </span>
                                    </span>
                                    <span class="mt-0.5 ml-4 min-w-0 flex flex-col">
                                        <span
                                            class="
                                                text-xs
                                                font-semibold
                                                tracking-wide
                                                uppercase
                                            "
                                            >{{ tab.props.title }}</span
                                        >
                                        <span
                                            class="
                                                text-sm
                                                font-medium
                                                text-darken-primary
                                            "
                                            v-if="tab.props.description"
                                            >{{ tab.props.description }}</span
                                        >
                                    </span>
                                </span>
                            </a>
                            <a
                                v-else-if="index === state.selectedIndex"
                                aria-current="step"
                            >
                                <span
                                    class="
                                        absolute
                                        top-0
                                        left-0
                                        w-1
                                        h-full
                                        bg-primary
                                        lg:w-full lg:h-1 lg:bottom-0 lg:top-auto
                                    "
                                    :class="{
                                        'bg-primary': !state.selectedTabError,
                                        'bg-danger': state.selectedTabError,
                                    }"
                                    aria-hidden="true"
                                />
                                <span
                                    :class="[
                                        index !== 0 ? 'lg:pl-9' : '',
                                        'px-6 py-5 flex items-start text-sm font-medium',
                                    ]"
                                >
                                    <span class="shrink-0">
                                        <span
                                            class="
                                                w-10
                                                h-10
                                                flex
                                                items-center
                                                justify-center
                                                border-2
                                            "
                                            :class="{
                                                'border-primary bg-primary': !state.selectedTabError,
                                                'border-danger bg-danger': state.selectedTabError,
                                            }"
                                        >
                                            <span
                                                class="text-white"
                                                >{{
                                                    tab.props.step || index + 1
                                                }}</span
                                            >
                                        </span>
                                    </span>
                                    <span class="mt-0.5 ml-4 min-w-0 flex flex-col">
                                        <span
                                            class="
                                                text-xs
                                                font-semibold
                                                tracking-wide
                                                uppercase
                                            "
                                            :class="{
                                                'text-primary': !state.selectedTabError,
                                                'text-danger': state.selectedTabError,
                                            }"
                                            >{{ tab.props.title }}</span
                                        >
                                        <span
                                            class="text-sm font-medium"
                                            :class="{
                                                'text-darken-primary':
                                                    !state.selectedTabError,
                                                'text-danger': state.selectedTabError,
                                            }"
                                            v-if="tab.props.description"
                                            >{{ tab.props.description }}</span
                                        >
                                    </span>
                                </span>
                            </a>
                            <a v-else class="group">
                                <span
                                    class="
                                        absolute
                                        top-0
                                        left-0
                                        w-1
                                        h-full
                                        bg-transparent
                                        group-hover:bg-dark-secondary
                                        lg:w-full lg:h-1 lg:bottom-0 lg:top-auto
                                    "
                                    aria-hidden="true"
                                />
                                <span
                                    :class="[
                                        index !== 0 ? 'lg:pl-9' : '',
                                        'px-6 py-5 flex items-start text-sm font-medium',
                                    ]"
                                >
                                    <span class="shrink-0">
                                        <span
                                            class="
                                                w-10
                                                h-10
                                                flex
                                                items-center
                                                justify-center
                                                border-2 border-dark-secondary
                                            "
                                        >
                                            <span class="text-darken-primary">{{
                                                tab.props.step || index + 1
                                            }}</span>
                                        </span>
                                    </span>
                                    <span
                                        class="
                                            mt-0.5
                                            ml-4
                                            min-w-0
                                            flex flex-col
                                            justify-items-center
                                        "
                                    >
                                        <span
                                            class="
                                                text-xs
                                                font-semibold
                                                text-darken-primary
                                                tracking-wide
                                                uppercase
                                            "
                                            >{{ tab.props.title }}</span
                                        >
                                        <span
                                            class="
                                                text-sm
                                                font-medium
                                                text-darken-primary
                                            "
                                            v-if="tab.props.description"
                                            >{{ tab.props.description }}</span
                                        >
                                    </span>
                                </span>
                            </a>
                            <template v-if="index !== 0">
                                <!-- Separator -->
                                <div
                                    class="
                                        hidden
                                        absolute
                                        top-0
                                        left-0
                                        w-3
                                        inset-0
                                        lg:block
                                    "
                                    aria-hidden="true"
                                >
                                </div>
                            </template>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="py-4">
                <slot></slot>
            </div>
        </div>
        <div class="py-4">
            <slot name="footer"></slot>
        </div>
        <div class="pt-8 flex justify-between">
            <div>
                <BaseButton
                    @click="previousTab"
                    v-if="state.selectedIndex > 0"
                    >{{previousButtonText}}</BaseButton
                >
            </div>
            <div>
                <BaseButton @click="nextTab">
                    <span v-if="state.selectedIndex < state.tabs.length - 1">{{nextButtonText}}</span>
                    <span v-if="state.selectedIndex == state.tabs.length - 1">{{finishButtonText}}</span>
                </BaseButton>
            </div>
        </div>
    </ParentTransition>
</template>

<script>
export default {
    name: "FormWizard",
}
</script>

<script setup>
import { CheckIcon } from "@heroicons/vue/20/solid"
import {
    useSlots,
    reactive,
    provide,
    onMounted,
    onBeforeMount,
} from "vue"
import { isPromise } from '@core/utils/helper'

const props = defineProps({
    nextButtonText: {
        type: String,
        default: 'Next'
    },
    previousButtonText: {
        type: String,
        default: 'Previous'
    },
    finishButtonText: {
        type: String,
        default: 'Finish'
    }
})

const slots = useSlots()
const emit = defineEmits(['complete'])

const state = reactive({
    selectedIndex: 0,
    selectedTabError: false,
    tabs: [],
    count: 0,
})

provide("TabsProvider", state)

onBeforeMount(() => {
    if (slots.default) {
        state.tabs = slots
            .default()
            .filter((child) => child.type.name === "TabContent")
    }
})

onMounted(() => {
    let index = state.tabs.findIndex((tab) =>
        tab.props.hasOwnProperty("is-selected")
    )

    state.selectedIndex = index === -1 ? 0 : index
})

const previousTab = () => {
    if (state.selectedIndex === 0) {
        return
    }

    state.selectedTabError = false
    state.selectedIndex -= 1
}

const nextTab = () => {
    beforeChange()
}

const changeTab = (result) => {
    if (result === false) {
        state.selectedTabError = true
        return
    }

    state.selectedTabError = false

    if (state.selectedIndex === state.tabs.length - 1) {
        emit('complete')
        return
    }

    state.selectedIndex++

    afterLoad()
}

const selectTab = (index) => {
    if (index === state.selectedIndex) {
        return;
    } else if (index < state.selectedIndex) {
        previousTab()
    } else {
        nextTab()
    }
}

const beforeChange = () => {
    let selectedTab = state.tabs[state.selectedIndex]
    let selectedTabProps = selectedTab.props

    if (! selectedTabProps.hasOwnProperty("before-change")) {
        changeTab(true)
    }

    if (typeof selectedTabProps['before-change'] !== "function") {
        changeTab(true)
    }

    let result = selectedTabProps['before-change']()

    if (isPromise(result)) {
        result.then((res) => changeTab(res))
    } else if (typeof result === 'boolean') {
        changeTab(result)
    }
}

const afterLoad = () => {
    let selectedTab = state.tabs[state.selectedIndex]
    let selectedTabProps = selectedTab.props

    if (! selectedTabProps.hasOwnProperty("after-load")) {
        return
    }

    if (typeof selectedTabProps["after-load"] !== "function") {
        return
    }

    selectedTab.props["after-load"]()
}
</script>
