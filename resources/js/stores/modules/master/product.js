import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/master/products',
    formErrors: {}
})

const product = {
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
export default product