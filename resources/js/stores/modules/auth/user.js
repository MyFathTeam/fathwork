import axios from 'axios'
import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    user: {
        uuid: '',
        email: '',
        username: '',
        status: '',
        avatar: '',
        profile: {},
        roles: [],
        permissions: [],
        preference: {
            system: {},
            layout: {}
        },
        isSuperAdmin: false
    },
    formErrors: {}
})

const user = {
    namespaced: true,
    state: initialState,
    mutations: {
        ...mutations,
        SET_USER_UUID: (state, payload = '') => { state.user.uuid = payload },
        SET_USER_EMAIL: (state, payload = '') => { state.user.email = payload },
        SET_USER_USERNAME: (state, payload = '') => { state.user.username = payload },
        SET_USER_STATUS: (state, payload = '') => { state.user.status = payload },
        SET_USER_AVATAR: (state, payload = '') => { state.user.avatar = payload },
        SET_USER_PROFILE: (state, payload = {}) => { state.user.profile = payload },
        SET_USER_ROLES: (state, payload = []) => { state.user.roles = payload },
        SET_USER_PERMISSIONS: (state, payload = []) => { state.user.permissions = payload },
        SET_USER_PREFERENCE: (state, payload = {}) => { state.user.preference = payload },
        SET_IS_SUPER_ADMIN: (state, payload = {}) => { state.user.isSuperAdmin = payload },
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        async setCSRF() {
            await axios.get('/sanctum/csrf-cookie').then(() => { }).catch(error => {
                throw error
            })
        },
        async setUser({ commit }, payload) {
            commit('SET_USER_UUID', payload.uuid)
            commit('SET_USER_EMAIL', payload.email)
            commit('SET_USER_USERNAME', payload.username)
            commit('SET_USER_STATUS', payload.status)
            commit('SET_USER_AVATAR', payload.avatar)
            commit('SET_USER_PROFILE', payload.profile)
            commit('SET_USER_ROLES', payload.roles)
            commit('SET_USER_PERMISSIONS', payload.permissions)
            commit('SET_USER_PREFERENCE', payload.preference)
            commit('SET_IS_SUPER_ADMIN', payload.isSuperAdmin ? true : false)
        },
        async setUserPreference({ commit }, payload) {
            commit('SET_USER_PREFERENCE', payload.preference)
        },
        async login({ commit, dispatch, getters }, payload) {
            await Api.custom({
                url: '/auth/login',
                method: 'POST',
                data: payload.form
            }).then(response => {
                Form.hideLoader(payload);
                dispatch('setUser', response.user)
                toast.success(response.message)
            }).catch(error => {
                Form.hideLoader(payload);
                commit('SET_FORM_ERRORS', Form.getErrors(error))
                throw error
            })

            await dispatch('config/get', null, { root: true })
            await dispatch('layout/setLayout', getters.preference.layout, { root: true })

            await dispatch('navigation/setNavigation', null, { root: true })
        },
        async logout({ commit, dispatch }, payload = {}) {
            await Api.custom({
                url: '/auth/logout',
                method: 'POST'
            }).then(response => {
                Form.hideLoader(payload);
                commit('RESET_STATE')
                toast.success(response.message)
            }).catch(error => {
                Form.hideLoader(payload);
                commit('RESET_STATE')
            })

            await dispatch('config/get', null, { root: true })

            await dispatch('navigation/resetNavigation', null, { root: true })
        },
        async fetch({ commit, dispatch }, payload) {
            return await Api.custom({
                url: '/auth/user',
                method: 'GET'
            }).then(response => {
                Form.hideLoader(payload);
                dispatch('setUser', response)
                return response
            }).catch(error => {
                Form.hideLoader(payload);
                store.dispatch('auth/user/logout').then(() => {}).catch(e => {})
                throw error
            })
        },
    },
    getters: {
        ...getters,
        getUser: (state) => state.user,
        user: state =>  args => {
            const keys = args.split('.')
            let toReturn = state.user;
            keys.forEach(key => {
                toReturn = toReturn[key]
            })
            return toReturn
        },
        preference: state => state.user.preference,
        isSuperAdmin: state => state.user.isSuperAdmin,
        hasRole: state => role => state.user.roles.includes('*') || state.user.roles.indexOf(role) !== -1,
        hasAnyRole: state => (roles = []) => state.user.roles.includes('*') || state.user.roles.some(role => roles.indexOf(role) !== -1),
        hasAllRoles: state => (roles = []) => state.user.roles.includes('*') || state.user.roles.every(role => roles.indexOf(role) !== -1),
        hasPermission: state => permission => state.user.permissions.includes('*') || state.user.permissions.indexOf(permission) !== -1,
        hasAnyPermission: state => (permissions = []) => state.user.permissions.includes('*') || permissions.some(permission => state.user.permissions.indexOf(permission) !== -1),
        hasAllPermissions: state => (permissions = []) => state.user.permissions.includes('*') || permissions.every(permission => state.user.permissions.indexOf(permission) !== -1)
    }
}

export default user
