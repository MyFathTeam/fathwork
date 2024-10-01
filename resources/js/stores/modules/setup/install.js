import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    initURL: '/install',
    preRequisites: [],
    app: {},
    formErrors: {}
})

const install = {
    namespaced: true,
    state: initialState,
    mutations: {
        ...mutations,
        SET_PREREQUISITES: (state, payload = []) => {
            state.preRequisites = payload
        },
        SET_APP: (state, payload = {}) => {
            state.app = payload
        },
    },
    actions: {
        fetchPreRequisite({ state, commit }, payload) {
            Api.custom({
                url: state.initURL + '/pre-requisite',
                method: 'GET'
            }).then(response => {
                commit('SET_PREREQUISITES', response.preRequisites)
                commit('SET_APP', response.app)
            }).catch(error => {
                Form.getErrors(error)
            })
        },
        validate({ state, commit }, payload) {
            return Api.custom({
                url: state.initURL + '?option=' + payload.option,
                method: 'POST',
                data: payload.form
            }).then(response => {
                return true
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })
        },
        async finish({ state, commit, dispatch }, payload) {
            await Api.custom({
                url: state.initURL,
                method: 'POST',
                data: payload.form
            }).then(response => {
                commit('RESET_STATE')
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })

            await dispatch('config/get', true, {root: true})
        },
    },
    getters: {
        ...getters,
        getPreRequisites: (state) => state.preRequisites,
        getApp: (state) => state.app,
        hasValidPreRequisite: (state) => {
            if (! state.preRequisites.length) {
                return true
            }

            let serverError = state.preRequisites
            .find((preRequisite) => preRequisite.key === "server")
            .items.findIndex((item) => item.type === "error");

            if (serverError >= 0) {
                return false;
            }

            let folderError = state.preRequisites
                .find((preRequisite) => preRequisite.key === "folder")
                .items.findIndex((item) => item.type === "error");

            if (folderError >= 0) {
                return false;
            }

            return true;
        }
    }
}

export default install
