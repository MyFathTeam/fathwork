<template>
    <ErrorPage type="404" :title="$trans('general.errors.404_title')" :description="$trans('general.errors.404_description')">
        <BaseButton type="button" @click="router.push({name: 'Dashboard'})">{{$trans('dashboard.dashboard')}}</BaseButton>
    </ErrorPage>
</template>

<script setup>
import { useRouter } from "vue-router"

const router = useRouter()
</script>
