<template>
    <ParentTransition appear :visibility="true">
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <div class="lg:col-start-2 col-span-1">
                <ImageUpload design="modern" shape="circle" class="h-64 w-64 rounded-full" :label="$trans('user.avatar')" :src="getAvatar" upload-path="user/profile/avatar" remove-path="user/profile/avatar" @uploaded="uploaded" @removed="removed" />
            </div>
        </div>
    </ParentTransition>
</template>

<script>
export default {

}
</script>

<script setup>
import { computed } from "vue"
import { useStore } from "vuex";

const store = useStore();

const getAvatar = computed(() => store.getters["auth/user/user"]('avatar'))

const uploaded = async () => {
    await store.dispatch('auth/user/fetch')
}

const removed = async () => {
    await store.dispatch('auth/user/fetch')
}
</script>