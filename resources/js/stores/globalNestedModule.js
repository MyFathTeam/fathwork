import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'

const toast = useToast()

const initialState = () => ({})

export const mutations = {
    SET_FORM_ERRORS: (state, payload = {}) => {
        state.formErrors = payload
    },
    RESET_STATE: (state) => {
        state = initialState
    },
}

export const actions = {
    resetFormErrors({ commit }) {
        commit('SET_FORM_ERRORS')
    },
    preRequisite({ state, commit }, payload) {
        let type = ''
        if (Array.isArray(payload.data)) {
            type = payload.data.join(",")
        } else {
            type = payload.data
        }

        let url = state.initURL + '/' + payload.uuid + state.module + '/pre-requisite'
        if (type) {
            url += ('?type=' + type)
        }

        return Api.custom({
            url,
            method: 'GET'
        })
        .then(response => {
            return response
        }).catch(error => {
            Form.getErrors(error)
            throw error
        })
    },
    list({ state, commit }, payload) {
        let url = state.initURL + '/' + payload.uuid + state.module
        return Api.list(url, payload.params)
        .then(response => {
            return response
        }).catch(error => {
            Form.getErrors(error)
            throw error
        })
    },
    async get({ state, commit }, payload) {
        let url = state.initURL + '/' + payload.uuid + state.module
        return await Api.get(url, payload.moduleUuid)
        .then(response => {
            return response
        }).catch(error => {
            Form.getErrors(error)
            throw error
        })
    },
    async create({ state, commit }, payload) {
        let url = state.initURL + '/' + payload.uuid + state.module
        await Api.store(url, payload.form)
        .then(response => {
            toast.success(response.message)
        }).catch(error => {
            commit('SET_FORM_ERRORS', Form.getErrors(error))
            throw error
        })
    },
    async update({ state, commit }, payload) {
        let url = state.initURL + '/' + payload.uuid + state.module
        await Api.update(url, payload.moduleUuid, payload.form)
        .then(response => {
            toast.success(response.message)
        }).catch(error => {
            commit('SET_FORM_ERRORS', Form.getErrors(error))
            throw error
        })
    },
    async delete({ state, commit }, payload) {
        let url = state.initURL + '/' + payload.uuid + state.module
        await Api.destroy(url, payload.moduleUuid)
        .then(response => {
            toast.success(response.message)
        }).catch(error => {
            Form.getErrors(error)
            throw error
        })
    },
    resetState({ commit }) {
        commit('RESET_STATE')
    },
}

export const getters = {
    getFormErrors: (state) => state.formErrors,
}

export default {
    mutations,
    getters,
    actions,
}
