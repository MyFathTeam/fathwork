import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/blog/posts',
    formErrors: {}
})

const post = {
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
export default post