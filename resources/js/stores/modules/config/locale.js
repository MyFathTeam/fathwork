import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/config/locales',
    formErrors: {}
})

const locale = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
        ...mutations
    },
    actions: {
        ...actions
    },
    getters: {
        ...getters
    }
}

export default locale
