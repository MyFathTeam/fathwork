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

        let url = state.initURL + '/pre-requisite'
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
        return Api.list(state.initURL, payload.params)
        .then(response => {
            return response
        }).catch(error => {
            Form.getErrors(error)
            throw error
        })
    },
    async get({ state, commit }, payload) {
        return await Api.get(state.initURL, payload.uuid)
        .then(response => {
            return response
        }).catch(error => {
            Form.getErrors(error)
            throw error
        })
    },
    async create({ state, commit }, payload) {
        await Api.store(state.initURL, payload.form)
        .then(response => {
            toast.success(response.message)
        }).catch(error => {
            commit('SET_FORM_ERRORS', Form.getErrors(error))
            throw error
        })
    },
    async update({ state, commit }, payload) {
        await Api.update(state.initURL, payload.uuid, payload.form)
        .then(response => {
            toast.success(response.message)
        }).catch(error => {
            commit('SET_FORM_ERRORS', Form.getErrors(error))
            throw error
        })
    },
    async delete({ state, commit }, payload) {
        await Api.destroy(state.initURL, payload.uuid)
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
