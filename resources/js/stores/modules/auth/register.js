import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    formErrors: {}
})

const register = {
    namespaced: true,
    state: initialState,
    mutations: {
        ...mutations
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        register({ commit }, payload) {
            return Api.custom({
                url: '/auth/register',
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
        emailRequest({ commit }, payload) {
            return Api.custom({
                url: '/auth/register/email',
                method: 'POST',
                data: payload.form
            }).then(response => {
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        emailVerification({ commit }, payload) {
            return Api.custom({
                url: '/auth/register/verify',
                method: 'POST',
                data: {
                    token: payload.token
                }
            }).then(response => {
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

export default register
