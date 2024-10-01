import profile from './profile'

export default [
    {
        path: 'users',
        name: 'User',
        redirect: { name: 'UserList' },
        meta: {
            label: 'user.user',
            icon: 'fas fa-users',
            hideChildren: true,
            permissions: ['user:read']
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: 'UserList',
                meta: {
                    trans: 'global.list',
                    label: 'user.user',
                },
                component: () => import('@views/Pages/User/Index.vue'),
            },
            {
                path: 'create',
                name: 'UserCreate',
                meta: {
                    type: 'create',
                    action: 'create',
                    trans: 'global.add',
                    label: 'user.user',
                    permissions: ['user:create']
                },
                component: () => import('@views/Pages/User/Action.vue'),
            },
            {
                path: ':uuid/edit',
                name: 'UserEdit',
                meta: {
                    type: 'edit',
                    action: 'update',
                    trans: 'global.edit',
                    label: 'user.user',
                    permissions: ['user:edit']
                },
                component: () => import('@views/Pages/User/Action.vue'),
            },
            // {
            //     path: ':uuid',
            //     name: 'UserShow',
            //     meta: {
            //         trans: 'global.detail',
            //         label: 'user.user',
            //     },
            //     component: () => import('@views/Pages/User/Show.vue'),
            // }
        ]
    },
    {
        path: 'failed-login-attempts',
        name: 'FailedLoginAttempt',
        meta: {
            roles: ['admin'],
            label: 'auth.failed_login_attempt',
            icon: 'fas fa-user-times',
            isHiddenNav: true,
        },
        component: () => import('@views/Pages/Auth/FailedLoginAttempt.vue'),
    },
    ...profile
]
