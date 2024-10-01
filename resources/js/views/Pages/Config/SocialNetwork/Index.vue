<template>
    <ConfigPage>
        <FormAction
            no-card
            :init-url="initUrl"
            data-fetch="social_network"
            :init-form="initForm"
            :form="form"
            action="store"
            stay-on
            redirect="Config"
        >
            <CardHeader first :title="$trans('config.social.social_config')" :description="$trans('config.social.social_info')"></CardHeader>
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-2">
                    <BaseInput
                        type="text"
                        leading-icon="fab fa-facebook"
                        v-model="form.facebook"
                        name="facebook"
                        :label="
                            $trans('config.social.props.facebook')
                        "
                        v-model:error="formErrors.facebook"
                        autofocus
                    />
                </div>
                <div class="col-span-3 sm:col-span-2">
                    <BaseInput
                        type="text"
                        leading-icon="fab fa-twitter"
                        v-model="form.twitter"
                        name="twitter"
                        :label="
                            $trans('config.social.props.twitter')
                        "
                        v-model:error="formErrors.twitter"
                    />
                </div>
                <div class="col-span-3 sm:col-span-2">
                    <BaseInput
                        type="text"
                        leading-icon="fab fa-google"
                        v-model="form.google"
                        name="google"
                        :label="
                            $trans('config.social.props.google')
                        "
                        v-model:error="formErrors.google"
                    />
                </div>
                <div class="col-span-3 sm:col-span-2">
                    <BaseInput
                        type="text"
                        leading-icon="fab fa-linkedin"
                        v-model="form.linkedin"
                        name="linkedin"
                        :label="
                            $trans('config.social.props.linkedin')
                        "
                        v-model:error="formErrors.linkedin"
                    />
                </div>
                <div class="col-span-3 sm:col-span-2">
                    <BaseInput
                        type="text"
                        leading-icon="fab fa-youtube"
                        v-model="form.youtube"
                        name="youtube"
                        :label="
                            $trans('config.social.props.youtube')
                        "
                        v-model:error="formErrors.youtube"
                    />
                </div>
                <div class="col-span-3 sm:col-span-2">
                    <BaseInput
                        type="text"
                        leading-icon="fab fa-github"
                        v-model="form.github"
                        name="github"
                        :label="
                            $trans('config.social.props.github')
                        "
                        v-model:error="formErrors.github"
                    />
                </div>
            </div>
        </FormAction>
    </ConfigPage>
</template>

<script>
export default {
    name: 'ConfigSocialNetworkForm'
}
</script>

<script setup>
import { reactive } from "vue";
import { getFormErrors } from "@core/helpers/action"

const initUrl = "config/"
const formErrors = getFormErrors(initUrl);

const initForm = {
    facebook: "",
    twitter: "",
    google: "",
    linkedin: "",
    youtube: "",
    github: "",
    type: 'social_network'
};

const form = reactive({ ...initForm })
</script>
