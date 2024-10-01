import '@core/utils/lodash'
import { cloneDeep } from "@core/utils"
import store from '@stores'
import routes from '@routes/modules/index'

function filterAccessibleNavigations(routes) {
    const accessibleNavigations = routes.filter(route => {
        let isAccessible = false;

        if (! route.meta) {
            isAccessible = true
        } else {
            if (route.meta.isNotNav === true) {
                return false
            } else if (route.meta.isNotNav) {
                //
            }

            let allowedRoles = false
            let allowedPermissions = false

            if (route.meta.hasOwnProperty('feature')) {
                if (! store.getters['config/configs'].feature[route.meta.feature]) {
                    return false
                }
            }

            if (route.meta.hasOwnProperty('superAdmin') && route.meta.superAdmin) {
                let isSuperAdmin = store.getters['auth/user/isSuperAdmin']
                if (! isSuperAdmin) {
                    return false
                }
            }

            if(route.meta.hasOwnProperty('roles') && route.meta.roles.length) {
                allowedRoles = store.getters['auth/user/hasAnyRole'](route.meta.roles)
                if (! allowedRoles) {
                    return false
                }
            }

            if(route.meta.hasOwnProperty('permissions') && route.meta.permissions.length) {
                allowedPermissions = route.meta.allPermissions
                                        ? store.getters['auth/user/hasAllPermissions'](route.meta.permissions)
                                        : store.getters['auth/user/hasAnyPermission'](route.meta.permissions)
                if (! allowedPermissions) {
                    return false
                }
            }

            isAccessible = true
        }

        if (isAccessible) {
            if (route.children && route.children.length) {
                route.children = filterAccessibleNavigations(route.children)
            }
            return true
        }
        return false
    })

    return accessibleNavigations
}

let accessibleConfigRoutes = []
function filterAccessibleConfigNavigations(routes) {
    routes.map(route => {
        if (! accessibleConfigRoutes.length) {
            if (route.name === 'Config') {
                accessibleConfigRoutes = route
            } else if (route.children && route.children.length) {
                accessibleConfigRoutes = filterAccessibleConfigNavigations(route.children)
            }
        }
    })

    return accessibleConfigRoutes
}

const initialState = () => ({
    navigations: [],
    configNavigations: []
})

const navigation = {
    namespaced: true,
    modules: {},
    state: initialState,
    mutations: {
        SET_NAVIGATION: (state, {navigations = [], configNavigations = []}) => {
            state.navigations = navigations
            state.configNavigations = configNavigations
        },
        RESET_NAVIGATION: (state) => {
            state.navigations = []
            state.configNavigations = []
        }
    },
    actions: {
        setNavigation({ commit }) {
            const navigations = filterAccessibleNavigations(_.cloneDeep(routes))
            let configNavigations = filterAccessibleConfigNavigations(navigations)

            commit('SET_NAVIGATION', {
                navigations: navigations,
                configNavigations: configNavigations ? configNavigations.children : [],
            })
        },
        resetNavigation({ commit }) {
            commit('RESET_NAVIGATION')
        }
    },
    getters: {
        navigations: state => state.navigations,
        configNavigations: state => state.configNavigations,
    }
}

export default navigation
