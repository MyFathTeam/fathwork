<template>
    <ErrorPage type="401" :title="$trans('general.errors.401_title')" :description="$trans('general.errors.401_description')">
        <BaseButton type="button" @click="router.push({name: 'Dashboard'})">{{$trans('dashboard.dashboard')}}</BaseButton>
    </ErrorPage>
</template>

<script setup>
import { useRouter } from "vue-router"

const router = useRouter()
</script>
