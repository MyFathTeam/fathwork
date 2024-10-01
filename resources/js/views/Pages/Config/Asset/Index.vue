<template>
    <ConfigPage>
        <CardHeader first :title="$trans('config.asset.asset_config')" :description="$trans('config.asset.asset_info')"></CardHeader>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="col-span-1">
                <ImageUpload recommended-size="600x200" design="modern" :object-fit="false" :label="$trans('config.asset.logo')" show-label :src="getAsset('logo')" upload-path="config/assets?type=logo" remove-path="config/assets?type=logo" @uploaded="uploaded" @removed="removed" />
            </div>
            <div class="col-span-1">
                <ImageUpload recommended-size="600x200" design="modern" :object-fit="false" :label="$trans('config.asset.logo_light')" show-label :src="getAsset('logoLight')" dark upload-path="config/assets?type=logo_light" remove-path="config/assets?type=logo_light" @uploaded="uploaded" @removed="removed" />
            </div>
            <div class="col-span-1">
                <ImageUpload recommended-size="512x512" design="modern" :object-fit="false" :label="$trans('config.asset.icon')" show-label :src="getAsset('icon')" upload-path="config/assets?type=icon" remove-path="config/assets?type=icon" @uploaded="uploaded" @removed="removed" />
            </div>
            <div class="col-span-1">
                <ImageUpload recommended-size="512x512" design="modern" :object-fit="false" :label="$trans('config.asset.icon_light')" show-label :src="getAsset('iconLight')" dark upload-path="config/assets?type=icon_light" remove-path="config/assets?type=icon_light" @uploaded="uploaded" @removed="removed" />
            </div>
            <div class="col-span-1">
                <ImageUpload recommended-size="128x128" design="modern" :object-fit="false" :label="$trans('config.asset.favicon')" show-label :src="getAsset('favicon')" upload-path="config/assets?type=favicon" remove-path="config/assets?type=favicon" @uploaded="uploaded" @removed="removed" />
            </div>
        </div>
    </ConfigPage>
</template>

<script>
export default {
    name: 'ConfigAsset'
}
</script>

<script setup>
import { useStore } from "vuex"
import { getConfig } from "@core/helpers/action"

const store = useStore()

const getAsset = (type) => {
    return getConfig('assets.' + type).value
}

const uploaded = async () => {
    await store.dispatch('config/get', false)
}

const removed = async () => {
    await store.dispatch('config/get', false)
}
</script>