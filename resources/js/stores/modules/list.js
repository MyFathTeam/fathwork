import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { actions } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    initURL: '/lists',
    formErrors: {}
})

const list = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
    },
    actions: {
        preRequisite: actions.preRequisite,
    },
    getters: {
    }
}

export default list
