import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/failed-login-attempts',
    formErrors: {}
})

const failedLoginAttempt = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
        ...mutations,
    },
    actions: {
        list: actions.list,
    },
    getters: {
        ...getters,
    }
}

export default failedLoginAttempt
