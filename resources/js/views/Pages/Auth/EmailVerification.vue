<template>
    <GuestHeader :label="$trans('auth.register.email_verification')"></GuestHeader>

    <ParentTransition appear :visibility="true">
        <BaseCard :is-loading="isLoading"></BaseCard>
    </ParentTransition>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useStore } from 'vuex'
import { useRouter, useRoute } from 'vue-router'

const store = useStore()
const router = useRouter()
const route = useRoute()

const isLoading = ref(null);

onMounted(() => {
    isLoading.value = true
    store.dispatch('auth/register/emailVerification', {
        token: route.params.token
    }).then(response => {
        isLoading.value = false
    }).catch(e => {
        isLoading.value = false
    })

    router.push({name: 'Login'})
})
</script>
