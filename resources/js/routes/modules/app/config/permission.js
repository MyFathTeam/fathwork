export default [
    {
        path: 'permission',
        name: 'ConfigPermission',
        redirect: { name: 'ConfigPermissionAssign' },
        meta: {
            label: 'config.permission.permission',
            icon: 'fas fa-key',
            hideChildren: true,
            key: 'permission'
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: 'ConfigPermissionAssign',
                meta: {
                    trans: 'global.assign',
                    label: 'config.permission.permission',
                },
                component: () => import('@views/Pages/Config/Permission/Index.vue'),
            },
            {
                path: ':module',
                name: 'ConfigPermissionAssignModule',
                meta: {
                    trans: 'global.assign',
                    label: 'config.permission.permission',
                },
                component: () => import('@views/Pages/Config/Permission/Index.vue'),
            },
        ]
    },
    {
        path: 'user-permission',
        name: 'ConfigUserPermission',
        meta: {
            isNotNav: true,
            label: 'config.permission.user_permission',
            icon: 'fas fa-key',
            key: 'user-permission'
        },
        component: () => import('@views/Pages/Config/Permission/User.vue'),
    }
]
