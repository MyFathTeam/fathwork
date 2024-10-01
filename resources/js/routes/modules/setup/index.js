import store from '@stores'

export default [
    {
        path: 'install',
        name: 'Install',
        meta: {
            title: 'setup.install.install_wizard',
        },
        component: () => import('@views/Pages/Install/Index.vue'),
        beforeEnter: ((to, from, next) => {
            const configs = store.getters['config/configs']
            if (! configs.requiresInstall) {
                next('/')
            } else {
                next()
            }
        })
    },
]
