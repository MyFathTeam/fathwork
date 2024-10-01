import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/blog/postcategories',
    formErrors: {}
})

const postcategory = {
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
export default postcategory
