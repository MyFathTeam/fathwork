import user from '@stores/modules/auth/user';
import register from '@stores/modules/auth/register';
import password from '@stores/modules/auth/password';
import failedLoginAttempt from '@stores/modules/auth/failedLoginAttempt';

const initialState = () => ({})

const auth = {
    namespaced: true,
    modules: {
        user,
        register,
        password,
        failedLoginAttempt
    },
    state: initialState,
    mutations: {
    },
    actions: {
    },
    getters: {
    }
}

export default auth
