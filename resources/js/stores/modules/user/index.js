import axios from 'axios'
import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { useToast } from 'vue-toastification'
import { mutations, actions, getters } from "@stores/global"

const toast = useToast()

import profile from '@stores/modules/user/profile';

const initialState = () => ({
    initURL: '/app/users',
    formErrors: {}
})

const user = {
    namespaced: true,
    state: initialState,
    modules: {
        profile
    },
    mutations: {
        ...mutations,
    },
    actions: {
        ...actions
    },
    getters: {
        ...getters
    }
}

export default user
