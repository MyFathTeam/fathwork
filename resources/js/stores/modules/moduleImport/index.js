import axios from 'axios'
import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

const initialState = () => ({
    initURL: '/app/',
    formErrors: {}
})

const moduleImport = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
        ...mutations
    },
    actions: {
        resetFormErrors: actions.resetFormErrors,
        upload({ state, commit }, payload) {
            return Api.custom({
                url: state.initURL + payload.path,
                method: 'POST',
                data: payload.data,
                upload: true,
            })
            .then(response => {
                commit('SET_FORM_ERRORS', {})
                toast.success(response.message)
                return response
            }).catch(error => {
                Form.getErrors(error)
                throw error
            })
        }
    },
    getters: {}
}

export default moduleImport
