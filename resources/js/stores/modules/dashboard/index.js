import axios from 'axios'
import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    initURL: '/app/dashboard/',
    formErrors: {}
})

const dashboard = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
        ...mutations
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        getStat({ state, commit }) {
            return Api.custom({
                url: state.initURL + "stat",
                method: 'GET'
            })
            .then(response => {
                return response
            }).catch(error => {
                throw error
            })
        },
        getAgenda({ state, commit }) {
            return Api.custom({
                url: state.initURL + "agenda",
                method: 'GET'
            })
            .then(response => {
                return response
            }).catch(error => {
                throw error
            })
        },
        getChart({ state,commit }) {
            return Api.custom({
                url: state.initURL + "chart",
                method: 'GET'
            })
            .then(response => {
                return response
            }).catch(error => {
                throw error
            })
        },
        getProject({ state,commit }) {
            return Api.custom({
                url: state.initURL + "project",
                method: 'GET'
            })
            .then(response => {
                return response
            }).catch(error => {
                throw error
            })
        }
    },
    getters: {}
}

export default dashboard
