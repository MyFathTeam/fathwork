import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    initURL: '/auth/password',
    passwordRequestSent: false,
    resetTokenConfirmed: false,
    formErrors: {}
})

const password = {
    namespaced: true,
    state: initialState,
    mutations: {
        ...mutations,
        SET_PASSWORD_REQUEST_SENT: (state, payload) => {
            state.passwordRequestSent = payload
        },
        SET_RESET_TOKEN_CONFIRMED: (state, payload) => {
            state.resetTokenConfirmed = payload
        },
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        passwordRequest({ state, commit }, payload) {
            return Api.custom({
                url: state.initURL + '/request',
                method: 'POST',
                data: {
                    email: payload.form.email
                }
            }).then(response => {
                commit('SET_PASSWORD_REQUEST_SENT', true)
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        resetTokenConfirm({ state, commit }, payload) {
            return Api.custom({
                url: state.initURL + '/confirm',
                method: 'POST',
                data: {
                    email: payload.form.email,
                    code: payload.form.code,
                }
            }).then(response => {
                commit('SET_RESET_TOKEN_CONFIRMED', true)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        resetPassword({ state, commit }, payload) {
            return Api.custom({
                url: state.initURL + '/reset',
                method: 'POST',
                data: payload.form
            }).then(response => {
                commit('SET_PASSWORD_REQUEST_SENT', false)
                commit('SET_RESET_TOKEN_CONFIRMED', false)
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
    },
    getters: {
        ...getters,
        isPasswordRequestSent: (state) => state.passwordRequestSent,
        isResetTokenConfirmed: (state) => state.resetTokenConfirmed
    }
}

export default password
