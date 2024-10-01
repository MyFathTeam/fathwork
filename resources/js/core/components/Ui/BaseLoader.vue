<template>
    <div class="relative" :class="{
        'h-20': minHeight,
    }" ref="loadingContainer">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'BaseLoader'
}
</script>

<script setup>
import { ref, computed, watch } from "vue"
import { useLoading } from 'vue-loading-overlay'

const $loading = useLoading({});

const props = defineProps({
    isLoading: {
        type: Boolean,
        default: false
    },
    minHeight: {
        type: Boolean,
        default: false
    }
})

const loadingContainer = ref(false)
let loader = null

const isLoading = computed(() => {
    return props.isLoading
})

watch(isLoading, (value, oldValue) => {
    if(value) {
        loader = $loading.show({ container: loadingContainer.value })
    } else if(loader){
        loader.hide()
    }
})
</script>
