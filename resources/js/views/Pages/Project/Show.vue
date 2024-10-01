<template>
    <PageHeader
        :title="
            $trans(route.meta.trans, {
                attribute: $trans(route.meta.label),
            })
        "
        :navs="[{ label: $trans('project.project'), path: 'ProjectList' }]"
    >
        <PageHeaderAction
            name="Project"
            :title="$trans('project.project')"
            :actions="['list']"
        />
    </PageHeader>

    <ParentTransition appear :visibility="true">
        <ShowItem
            :init-url="initUrl"
            :uuid="route.params.uuid"
            @setItem="setItem"
            @redirectTo="router.push({name: 'Project'})"
        >
            <BaseCard v-if="project.uuid">
                <template #title>
                    {{project.title}}
                </template>
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <BaseDataView class="col-span-1 sm:col-span-2" :label="$trans('project.props.description')">
                        <div v-html="project.description"></div>
                    </BaseDataView>

                    <BaseDataView class="col-span-1 sm:col-span-2">
                        <ListMedia :media="project.media" :url="`/app/projects/${project.uuid}/`" />
                    </BaseDataView>

                    <BaseDataView :label="$trans('general.created_at')">
                        {{project.createdAt}}
                    </BaseDataView>

                    <BaseDataView :label="$trans('general.updated_at')">
                        {{project.updatedAt}}
                    </BaseDataView>
                </dl>
                <template #footer>
                    <ShowButton>
                        <BaseButton design="primary" @click="router.push({name: 'ProjectEdit', params: {uuid: project.uuid}})">
                            {{$trans("general.edit")}}
                        </BaseButton>
                    </ShowButton>
                </template>
            </BaseCard>
        </ShowItem>
    </ParentTransition>
</template>

<script>
export default {
    name: "ProjectShow"
}
</script>

<script setup>
import { reactive } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const initialProject = {};

const initUrl = "project/"

const project = reactive({ ...initialProject });

const setItem = (data) => {
    Object.assign(project, data);
};
</script>
