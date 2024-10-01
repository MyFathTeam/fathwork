import axios from 'axios'
import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    initURL: '/app/user',
    initAuthURL: '/auth/user',
    formErrors: {}
})

const profile = {
    namespaced: true,
    state: initialState,
    mutations: {
        ...mutations
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        async fetch({ state, commit, dispatch }, payload) {
            await Api.custom({
                url: state.initAuthURL,
                method: 'GET'
            }).then(response => {
                dispatch('auth/user/setUser', response, { root: true })
            }).catch(error => {
                dispatch('auth/user/logout', null, { root: true }).then(() => {}).catch(e => {})
                throw error
            })
        },
        async preference({ state, commit, dispatch }, payload) {
            await Api.custom({
                url: state.initURL + '/preference',
                method: 'POST',
                data: payload.form
            }).then(response => {
                commit('SET_FORM_ERRORS', {})
                dispatch('auth/user/setUserPreference', response.user.preference, { root: true })
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        changePassword({ state, commit }, payload) {
            return Api.custom({
                url: state.initURL + '/password',
                method: 'POST',
                data: payload.form
            }).then(response => {
                commit('SET_FORM_ERRORS', {})
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async updateProfile({ state, commit, dispatch }, payload) {
            return await Api.custom({
                url: state.initURL + '/profile',
                method: 'POST',
                data: payload.form
            }).then(response => {
                commit('SET_FORM_ERRORS', {})
                dispatch('auth/user/setUser', response.user, { root: true })
                toast.success(response.message)
                return response
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async updateAccount({ state, commit, dispatch }, payload) {
            return await Api.custom({
                url: state.initURL + '/profile/account',
                method: 'POST',
                data: payload.form
            }).then(response => {
                commit('SET_FORM_ERRORS', {})
                dispatch('auth/user/setUser', response.user, { root: true })
                toast.success(response.message)
                return response
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async verifyAccount({ state, commit, dispatch }, payload) {
            return await Api.custom({
                url: state.initURL + '/profile/verify',
                method: 'POST',
                data: payload.form
            }).then(response => {
                commit('SET_FORM_ERRORS', {})
                dispatch('auth/user/setUser', response.user, { root: true })
                toast.success(response.message)
                return response
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
    },
    getters: {
        ...getters
    }
}

export default profile
