import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    initURL: '/app/utility/backups',
    formErrors: {}
})

const backup = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
        ...mutations
    },
    actions: {
        list: actions.list,
        delete: actions.delete,
        resetState: actions.resetState,
    },
    getters: {
        ...getters
    }
}

export default backup
