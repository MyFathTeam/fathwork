import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { toQueryString } from "@core/helpers/array"
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    initURL: '/app/utility/todos',
    optionURL: '/app/options',
    todos: {},
    todo: {},
    formErrors: {}
})

const todo = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
        ...mutations,
        SET_TODOS: (state, payload) => { state.todos = payload},
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        preRequisite: actions.preRequisite,
        list: actions.list,
        get: actions.get,
        create: actions.create,
        update: actions.update,
        delete: actions.delete,
        resetState: actions.resetState,
        async status({ state, commit }, payload) {
            await Api.custom({
                url: state.initURL + '/' + payload.uuid + '/status',
                method: 'POST'
            })
            .then(response => {
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async archive({ state, commit }, payload) {
            await Api.custom({
                url: state.initURL + '/' + payload.uuid + '/archive',
                method: 'POST'
            })
            .then(response => {
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async unarchive({ state, commit }, payload) {
            await Api.custom({
                url: state.initURL + '/' + payload.uuid + '/unarchive',
                method: 'POST'
            })
            .then(response => {
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        deleteItems({ state, commit }, payload) {
            let url = state.initURL + '/delete'
            return Api.custom({
                url: toQueryString(url, payload.params),
                method: 'POST',
                data: {
                    uuids: payload.uuids,
                    global: payload.global,
                }
            })
            .then(response => {
                toast.success(response.message)
            }).catch(error => {
                Form.getErrors(error)
                throw error
            })
        },
        async addList({ state, commit }, payload) {
            return await Api.custom({
                url: state.optionURL + '?type=todo_list',
                method: 'POST',
                data: payload.form
            })
            .then(response => {
                return response
                // toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async reorderList({ state, commit }, payload) {
            await Api.custom({
                url: state.optionURL + '/reorder?type=todo_list',
                method: 'POST',
                data: payload
            })
            .then(response => {
                // toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async moveList({ state, commit }, payload) {
            await Api.custom({
                url: state.initURL + '/lists/move',
                method: 'POST',
                data: payload
            })
            .then(response => {
                // toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async reorderItems({ state, commit }, payload) {
            await Api.custom({
                url: state.initURL + '/reorder',
                method: 'POST',
                data: payload
            })
            .then(response => {
                // toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
    },
    getters: {
        ...getters,
        listTodos: state => state.todos,
    }
}

export default todo
