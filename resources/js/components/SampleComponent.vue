<template>

</template>

<script>
export default {
    name: 'SampleComponent'
}
</script>

<script setup>
import { inject, reactive, ref, onMounted, watch } from "vue"
import { useRouter, useRoute, onBeforeRouteLeave } from "vue-router"
import { useStore } from "vuex"
// import other components

const router = useRouter()
const route = useRoute()
const store = useStore()

const emitter = inject('emitter')

const emit = defineEmits([])
const props = defineProps({})

const loadingContainer = ref(false)
const state = reactive({})

const sampleMethod = () => {

}

onMounted(() => {

})

watch(
    () => state,
    (newValue) => {}
)

onBeforeRouteLeave(() => {

})
</script>