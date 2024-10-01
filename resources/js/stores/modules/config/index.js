import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

import mailTemplate from '@stores/modules/config/mailTemplate';
import role from '@stores/modules/config/role';
import permission from '@stores/modules/config/permission';
import locale from '@stores/modules/config/locale';

const toast = useToast()

const initialState = () => ({
    initURL: '/config',
    initAppURL: '/app/config',
    config: {
        auth: {},
        system: {},
        general: {},
    },
    isLoaded: false,
    formErrors: []
})

const config = {
    namespaced: true,
    state: initialState,
    modules: {
        mailTemplate,
        role,
        permission,
        locale
    },
    mutations: {
        ...mutations,
        ADD_CONFIG: (state, data = {}) => {
            state.config = Object.assign({}, state.config, data)
        },
        SET_CONFIG: (state, data = {}) => {
            state.config = data;
        },
        SET_IS_LOADED: (state, value) => {
            state.isLoaded = value
        },
        RESET_CONFIG: (state) => {
            state.config = initialState.config
        }
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        preRequisite: actions.preRequisite,
        async get({ state, commit, dispatch }, reset) {
            if (reset) {
                commit('RESET_CONFIG')
            }

            await Api.custom({
                url: state.initURL,
                method: 'GET'
            }).then(response => {
                commit('ADD_CONFIG', response)
                commit('SET_IS_LOADED', true)
            }).catch(error => {
                commit('RESET_STATE')
                Form.getErrors(error)
            })
        },
        async fetch({ state, commit }, payload) {
            return await Api.custom({
                url: state.initAppURL + '?type=' + payload.type,
                method: 'GET'
            }).then(response => {
                return response
            }).catch(error => {
                Form.getErrors(error)
            })
        },
        async store({ state, commit }, payload) {
            return await Api.custom({
                url: state.initAppURL,
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
        async testMailConnection({ state, commit }, payload) {
            return await Api.custom({
                url: state.initAppURL + '/mail/test',
                method: 'GET'
            }).then(response => {
                commit('SET_FORM_ERRORS', {})
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
            })
        },
        async testPusherConnection({ state, commit }, payload) {
            return await Api.custom({
                url: state.initAppURL + '/pusher/test',
                method: 'GET'
            }).then(response => {
                commit('SET_FORM_ERRORS', {})
                toast.success(response.message)
            }).catch(error => {
                commit('SET_FORM_ERRORS', Form.getErrors(error))
            })
        },
        setConfig({ commit }, data) {
            commit('SET_CONFIG', data)
        },
        setLoaded({ commit }, value) {
            commit('SET_IS_LOADED', value)
        },
        resetConfig({ commit }) {
            commit('RESET_CONFIG')
        },
        resetState({ commit }) {
            commit('RESET_STATE')
        }
    },
    getters: {
        ...getters,
        configs: state => state.config,
        config: state => args => {
            const keys = args.split('.')
            let toReturn = state.config;

            keys.forEach(key => {
                if (toReturn === undefined) {
                    return null
                }
                toReturn = toReturn[key]
            })
            return toReturn
        },
        isLoaded: state => state.isLoaded,
    }
}

export default config
