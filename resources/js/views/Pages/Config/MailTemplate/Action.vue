<template>
    <ConfigPage no-background>

        <template #action>
            <PageHeaderAction
                name="ConfigMailTemplate"
                :title="$trans('config.mail.template.template')"
                :actions="['list']"
            />
        </template>

        <ParentTransition appear :visibility="true">
            <MailTemplateForm></MailTemplateForm>
        </ParentTransition>
    </ConfigPage>
</template>

<script>
export default {
    name: "ConfigMailTemplateAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import MailTemplateForm from "./Form.vue";

const route = useRoute();
</script>
