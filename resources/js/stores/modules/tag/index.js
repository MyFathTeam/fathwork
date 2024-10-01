import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/tags',
    formErrors: {}
})

const tag = {
    namespaced: true,
    state: initialState,
    modules: {
    },
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

export default tag
