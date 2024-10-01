<template>
    <ConfigPage no-background>

        <template #action>
            <PageHeaderAction
                name="ConfigLocale"
                :title="$trans('config.locale.locale')"
                :actions="['list']"
            />
        </template>

        <ParentTransition appear :visibility="true">
            <LocaleForm></LocaleForm>
        </ParentTransition>
    </ConfigPage>
</template>

<script>
export default {
    name: "LocaleAction",
};
</script>

<script setup>
import { useRoute } from "vue-router";
import LocaleForm from "./Form.vue";

const route = useRoute();
</script>
