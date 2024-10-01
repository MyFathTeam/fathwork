import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/master/productcategories',
    formErrors: {}
})

const productcategory = {
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
export default productcategory
