import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    initURL: '/app/config/permissions',
    formErrors: {}
})

const permission = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
        ...mutations
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        preRequisite: actions.preRequisite,
        async roleWiseAssign({ state, commit, dispatch }, payload) {
            await Api.store(state.initURL + '/role/assign', payload.form)
            .then(response => {
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })

            await dispatch('auth/user/fetch', null , {root: true})
        },
        async search({ state, commit }, payload) {
            return await Api.custom(state.initURL + '/search?q=' + payload.query)
            .then(response => {
                return response
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async searchUser({ state, commit }, payload) {
            return await Api.custom(state.initURL + '/user/search?q=' + payload.query)
            .then(response => {
                return response
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async userWiseAssign({ state, commit, dispatch }, payload) {
            await Api.store(state.initURL + '/user/assign', payload.form)
            .then(response => {
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })

            await dispatch('auth/user/fetch', null , {root: true})
        },
        resetState({ commit }) {
            commit('RESET_STATE')
        }
    },
    getters: {
        ...getters
    }
}

export default permission
