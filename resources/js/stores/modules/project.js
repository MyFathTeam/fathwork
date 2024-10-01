import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/projects',
    formErrors: {}
})

const project = {
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
export default project
