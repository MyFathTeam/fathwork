import store from '@stores'

export default [
    {
        path: 'login',
        name: 'Login',
        meta: {
            title: 'auth.login.page_title',
            description: 'auth.login.page_description',
        },
        component: () => import('@views/Pages/Auth/Login.vue'),
    },
    {
        path: 'register',
        name: 'Register',
        meta: {
            title: 'auth.register.page_title',
            description: 'auth.register.page_description',
        },
        component: () => import('@views/Pages/Auth/Register.vue'),
        beforeEnter: ((to, from, next) => {
            if (! store.getters['config/config']('auth.enableRegistration')) {
                next({name: 'Login'})
            } else {
                next()
            }
        })
    },
    {
        path: 'register/email',
        name: 'EmailRequest',
        meta: {
            title: 'auth.register.page_title',
            description: 'auth.register.page_description',
        },
        component: () => import('@views/Pages/Auth/EmailRequest.vue'),
        beforeEnter: ((to, from, next) => {
            if (! store.getters['config/config']('auth.enableRegistration')) {
                next({name: 'Login'})
            } else if (! store.getters['config/config']('auth.enableEmailVerification')) {
                next({name: 'Login'})
            } else {
                next()
            }
        })
    },
    {
        path: 'register/verify/:token',
        name: 'EmailVerification',
        meta: {
            title: 'auth.register.page_title',
            description: 'auth.register.page_description',
        },
        component: () => import('@views/Pages/Auth/EmailVerification.vue'),
        beforeEnter: ((to, from, next) => {
            if (! store.getters['config/config']('auth.enableRegistration')) {
                next({name: 'Login'})
            } else if (! store.getters['config/config']('auth.enableEmailVerification')) {
                next({name: 'Login'})
            } else {
                next()
            }
        })
    },
    {
        path: 'password',
        name: 'Password',
        meta: {
            title: 'auth.password.page_title',
            description: 'auth.password.page_description',
        },
        component: () => import('@views/Pages/Auth/Password.vue'),
        beforeEnter: ((to, from, next) => {
            if (! store.getters['config/config']('auth.enableResetPassword')) {
                next({name: 'Login'})
            } else {
                next()
            }
        })
    },
]
