import { createRouter, createWebHistory } from "vue-router"
import Echo from 'laravel-echo'
import NProgress from 'nprogress'
import store from '@stores'

const baseURL = '/app'
import routes from '@routes/modules/index'

store.dispatch('config/setLoaded', false)

const router = createRouter({
    history: createWebHistory(baseURL),
    routes: routes
})

router.beforeEach((to, from, next) => {
    const toFullPath = to.fullPath
    const toPath = to.path

    NProgress.start()

    if (toPath === '/error') {
        next()
    } else {
        setConfig().then(() => {
            const belongsTo = to.matched.some(m => m.meta.belongsTo) ? to.matched.find(m => m.meta.belongsTo).meta.belongsTo : ''

            if (to.meta.forceRedirect) {
                next(to.meta.forceRedirect)
            } else if (getConfig('requiresInstall') && toPath !== '/install') {
                next({ name: 'Install' })
            } else {
                if (belongsTo === 'auth') {
                    filterAccessibleRoutes(to, from, next)
                } else if (belongsTo === 'guest') {
                    if (getConfig('authenticated') === true) {
                        let toRoute = to.query && to.query.ref ? to.query.ref : { name: 'Dashboard' }
                        if (toRoute.name === from.name) {
                            NProgress.done()
                            next(false)
                        } else {
                            next(toRoute)
                        }
                    } else {
                        next()
                    }

                } else {
                    next()
                }
            }

        }).catch(error => {
            next({ name: 'Error', replace: true, query: { ref: to.fullPath } })
        })
    }
});

router.afterEach((to, from) => {
    NProgress.done()
});

router.onError(() => {
    NProgress.done()
})

async function filterAccessibleRoutes(to, from, next) {
    const toFullPath = to.fullPath
    const toPath = to.path
    const fromPath = from.path
    const validationRequired = to.matched.some(m => m.meta.validate)
        ? to.matched.find(m => m.meta.validate).meta.validate
        : []

    if (getConfig('authenticated') !== true) {
        await store.dispatch('auth/user/logout').then(() => {}).catch(e => {})
        return next({ name: 'Login', query: { ref: toFullPath } })
    }

    let allowedRoles = false
    let allowedPermissions = false

    if (to.meta.hasOwnProperty('feature')) {
        if (! store.getters['config/configs'].feature[to.meta.feature]) {
            return next({ name: 'Error404', replace: true, query: { ref: toFullPath } })
        }
    }

    if (to.meta.hasOwnProperty('superAdmin') && to.meta.superAdmin) {
        let isSuperAdmin = store.getters['auth/user/isSuperAdmin']
        if (! isSuperAdmin) {
            return next({ name: 'Error403', replace: true, query: { ref: toFullPath } })
        }
    }

    if (to.meta.hasOwnProperty('rolesExcept') && to.meta.rolesExcept.length) {
        if (store.getters['auth/user/hasAnyRole'](to.meta.rolesExcept)) {
            return next({ name: 'Error403', replace: true, query: { ref: toFullPath } })
        }
    }

    if (to.meta.hasOwnProperty('roles') && to.meta.roles.length) {
        allowedRoles = store.getters['auth/user/hasAnyRole'](to.meta.roles)
        if (! allowedRoles) {
            return next({ name: 'Error403', replace: true, query: { ref: toFullPath } })
        }
    }

    if (to.meta.hasOwnProperty('permissions') && to.meta.permissions.length) {
        allowedPermissions = to.meta.allPermissions
                                ? store.getters['auth/user/hasAllPermissions'](to.meta.permissions)
                                : store.getters['auth/user/hasAnyPermission'](to.meta.permissions)

        if (! allowedPermissions) {
            return next({ name: 'Error403', replace: true, query: { ref: toFullPath } })
        }
    }

    return next()
}

async function setConfig() {
    if (store.getters['config/isLoaded']) {
        return true
    }

    await store.dispatch('config/get', true)

    if (getConfig('authenticated') && ! store.getters["auth/user/user"]('uuid')) {
        await store.dispatch('auth/user/fetch')
        await store.dispatch('layout/setLayout', store.getters["auth/user/user"]('preference.layout'))

        await store.dispatch('navigation/setNavigation')
    }

    let notification = store.getters['config/config']('notification');

    if (notification?.enablePusherNotification) {
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: notification?.pusherAppKey,
            cluster: notification?.pusherAppCluster,
            forceTLS: true
        });
    }
}

function getConfig(key) {
    return store.getters['config/config'](key)
}

export default router
