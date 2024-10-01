import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/faththinks',
    formErrors: {}
})

const faththink = {
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
export default faththink
