<template>
    <ConfigPage no-background>

        <template #action>
            <PageHeaderAction
                name="ConfigMailTemplate"
                :title="$trans('config.mail.template.template')"
            />
        </template>

        <ParentTransition appear :visibility="true">
            <ShowItem
                :init-url="initUrl"
                :uuid="route.params.uuid"
                @setItem="setItem"
                @redirectTo="router.push({name: 'ConfigMailTemplate'})"
            >
                <BaseCard v-if="mailTemplate.uuid">
                    <template #title>
                        {{mailTemplate.subject}}
                    </template>

                    <div v-html="mailTemplate.body"></div>
                </BaseCard>
            </ShowItem>
        </ParentTransition>
    </ConfigPage>
</template>

<script>
export default {
    name: 'ConfigMailTemplateShow'
}
</script>

<script setup>
import { reactive, computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStore } from "vuex";

const store = useStore();
const route = useRoute();
const router = useRouter();

const initialMailTemplate = {};

const initUrl = "config/mailTemplate/"

const mailTemplate = reactive({ ...initialMailTemplate });

const setItem = (data) => {
    Object.assign(mailTemplate, data);
};
</script>
