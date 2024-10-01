import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/config/roles',
    formErrors: {}
})

const role = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
        ...mutations
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        list: actions.list,
        get: actions.get,
        create: actions.create,
        delete: actions.delete,
        resetState: actions.resetState,
    },
    getters: {
        ...getters
    }
}

export default role
