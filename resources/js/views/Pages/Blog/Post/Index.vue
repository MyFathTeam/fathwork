<template>
    <ListItem
        :init-url="initUrl"
        :pre-requisites="true"
        @setPreRequisites="setPreRequisites"
        @setItems="setItems"
    >
        <template #header>
            <PageHeader
                :title="$trans('blog.post.post')"
            >
                <PageHeaderAction
                    url="blog/posts/"
                    name="Post"
                    :title="$trans('blog.post.post')"
                    :actions="actions"
                    :dropdown-actions="dropdownActions"
                    @toggleFilter="showFilter = ! showFilter"
                    @toggleImport="showImport = ! showImport"
                />
            </PageHeader>
        </template>

        <template #import>
            <ParentTransition appear :visibility="showImport">
                <BaseImport path="blog/posts/import" @cancelled="showImport = false" @hide="showImport = false" @completed="emitter.emit('listItems')" />
            </ParentTransition>
        </template>

        <template #filter>
            <ParentTransition appear :visibility="showFilter">
                <FilterForm @refresh="emitter.emit('listItems')" :pre-requisites="preRequisites" @hide="showFilter = false"></FilterForm>
            </ParentTransition>
        </template>

        <ParentTransition appear :visibility="true">
            <DataTable
                :header="posts.headers"
                :meta="posts.meta"
                module="post"
                @refresh="emitter.emit('listItems')"
            >
                <DataRow v-for="post in posts.data" :key="post.uuid">
                    <DataCell name="name">
                        {{ post.name }}
                    </DataCell>
                    <DataCell name="postcategory">
                        {{ post.postcategorytitle }}
                    </DataCell>
                    <DataCell name="user">
                        {{ post.user.username }}
                    </DataCell>
                    <DataCell name="action">
                        <DropdownMenu v-if="post.isEditable || post.isDeletable || post.isReadtable || post.isCreatetable">
                            <DropdownItem post="fas fa-arrow-circle-right" v-if="post.isReadtable" @click="router.push({name: 'PostShow', params: {uuid: post.uuid}})">{{$trans('general.show')}}</DropdownItem>
                            <DropdownItem post="fas fa-edit" v-if="post.isEditable" @click="router.push({name: 'PostEdit', params: {uuid: post.uuid}})">{{$trans('general.edit')}}</DropdownItem>
                            <DropdownItem post="fas fa-copy" v-if="post.isCreatetable" @click="router.push({name: 'PostDuplicate', params: {uuid: post.uuid}})">{{$trans('general.duplicate')}}</DropdownItem>
                            <DropdownItem post="fas fa-trash" v-if="post.isDeletable" @click="emitter.emit('deleteItem', {
                                uuid: post.uuid
                            })">{{$trans('general.delete')}}</DropdownItem>
                        </DropdownMenu>
                    </DataCell>
                </DataRow>
                <template #actionButton>
                    <BaseButton @click="router.push({name: 'PostCreate'})" v-if="perform('post:create')">
                        {{$trans('global.add', {attribute: $trans('blog.post.post')})}}
                    </BaseButton>
                </template>
            </DataTable>
        </ParentTransition>
    </ListItem>
</template>

<script>
export default {
    name: 'PostList'
}
</script>

<script setup>
import { ref, reactive, inject } from "vue"
import { useRouter } from "vue-router"
import { perform } from "@core/helpers/action"  
import FilterForm from './filter.vue'

const router = useRouter()

const emitter = inject('emitter')

let actions = ['filter']
if (perform('post:create')) {
    actions.unshift('create')
}
let dropdownActions = [];
if (perform('post:export')) {
    dropdownActions = ['print', 'pdf', 'excel']
}

const initUrl = "blog/post/"
const preRequisites = reactive({})
const showFilter = ref(false)
const showImport = ref(false)

const posts = reactive({
    data: []
})

const setItems = (data) => {
    Object.assign(posts, data)
}
const setPreRequisites = (data) => {
    Object.assign(preRequisites, data)
}
</script>
