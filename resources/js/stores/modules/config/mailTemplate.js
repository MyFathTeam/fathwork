import { mutations, actions, getters } from "@stores/global"

const initialState = () => ({
    initURL: '/app/config/mail-templates',
    formErrors: {}
})

const mailTemplate = {
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

export default mailTemplate
