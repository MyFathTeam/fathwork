import * as Api from "@core/apis"
import * as Form from "@core/utils/form"

const initialState = () => ({
    sidebar: {
        mobile: false,
        type: 'mini',    // mini|full|pinned
    },
    display: 'dark'  // dark|light
})

const layout = {
    namespaced: true,
    state: initialState,
    modules: {},
    mutations: {
        SET_MOBILE_SIDEBAR: (state, payload) => { state.sidebar.mobile = payload},
        SET_SIDEBAR_TYPE: (state, payload) => { state.sidebar.type = payload},
        SET_DISPLAY: (state, payload) => { state.display = payload},
        RESET_STATE: (state) => {
            state = initialState
        }
    },
    actions: {
        setMobileSidebar({ commit }, payload) {
            commit('SET_MOBILE_SIDEBAR', payload)
        },
        async setSidebarType({ commit }, payload) {
            commit('SET_SIDEBAR_TYPE', payload)
        },
        async setDisplay({ commit }, payload) {
            commit('SET_DISPLAY', payload)
        },
        async setLayout({ commit }, payload = {}) {
            commit('SET_SIDEBAR_TYPE', payload.sidebar)

            if (payload.display === 'dark') {
                document.body.classList.add('dark')
            } else {
                document.body.classList.remove('dark')
            }
            commit('SET_DISPLAY', payload.display)
        },
        async setUserLayout({commit, dispatch}, payload) {
            await Api.custom({
                url: '/app/user/preference',
                method: 'POST',
                data: payload
            }).then(response => {
                dispatch('setLayout', response.user.preference.layout)
                dispatch('auth/user/setUserPreference', response.user, { root: true })
            }).catch(error => {
                throw error
            })
        },
        resetState({ commit }) {
            commit('RESET_STATE')
        }
    },
    getters: {
        mobileSidebar: state => state.sidebar.mobile ? true : false,
        getSidebarType: state => state.sidebar.type,
        getDisplay: state => state.display,
    }
}

export default layout
