import todo from '@stores/modules/utility/todo';
import backup from '@stores/modules/utility/backup';
import activityLog from '@stores/modules/utility/activityLog';

const initialState = () => ({})

const utility = {
    namespaced: true,
    state: initialState,
    modules: {
        todo,
        backup,
        activityLog
    },
    mutations: {
    },
    actions: {
    },
    getters: {
    }
}
export default utility
