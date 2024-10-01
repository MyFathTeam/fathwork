import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    initURL: '/app/options',
    formErrors: {}
})

const option = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
        ...mutations,
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        resetState: actions.resetState,
        preRequisite: actions.preRequisite,
        list({ state, commit }, payload) {
            if (payload.queryType != undefined) {
                payload.params['type'] = payload.queryType
            }
            return Api.list(state.initURL, payload.params)
            .then(response => {
                return response
            }).catch(error => {
                Form.getErrors(error)
                throw error
            })
        },
        async get({ state, commit }, payload) {
            return await Api.get(state.initURL, payload.uuid, {type: payload.queryType})
            .then(response => {
                return response
            }).catch(error => {
                Form.getErrors(error)
                throw error
            })
        },
        async create({ state, commit }, payload) {
            await Api.store(state.initURL, payload.form, {type: payload.queryType})
            .then(response => {
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async update({ state, commit }, payload) {
            await Api.update(state.initURL, payload.uuid, payload.form, {type: payload.queryType})
            .then(response => {
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async delete({ state, commit }, payload) {
            await Api.destroy(state.initURL, payload.uuid, {type: payload.queryType})
            .then(response => {
                toast.success(response.message)
            }).catch(error => {
                Form.getErrors(error)
                throw error
            })
        },
    },
    getters: {
        ...getters
    }
}

export default option
