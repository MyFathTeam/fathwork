export default [
    {
        path: 'role',
        name: 'ConfigRole',
        redirect: { name: 'ConfigRoleList' },
        meta: {
            label: 'config.role.role',
            icon: 'fas fa-user-tag',
            hideChildren: true,
            key: 'role'
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: 'ConfigRoleList',
                meta: {
                    trans: 'global.list',
                    label: 'config.role.role',
                },
                component: () => import('@views/Pages/Config/Role/Index.vue'),
            },
            {
                path: 'create',
                name: 'ConfigRoleCreate',
                meta: {
                    type: 'create',
                    action: 'create',
                    trans: 'global.add',
                    label: 'config.role.role',
                },
                component: () => import('@views/Pages/Config/Role/Action.vue'),
            },
        ]
    }
]
