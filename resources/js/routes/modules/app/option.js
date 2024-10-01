export const getOptionRoutes = (params = {
    path: '',
    prefix: '',
    label: '',
    queryType: '',
    key: '',
    navs: []
}) => {
    return {
        path: params.path,
        name: `${params.prefix}`,
        redirect: { name: `${params.prefix}List` },
        meta: {},
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: `${params.prefix}List`,
                meta: {
                    trans: 'global.list',
                    ...params
                },
                component: () => import('@views/Pages/Option/Index.vue'),
            },
            {
                path: 'create',
                name: `${params.prefix}Create`,
                meta: {
                    type: 'create',
                    action: 'create',
                    trans: 'global.add',
                    ...params
                },
                component: () => import('@views/Pages/Option/Action.vue'),
            },
            {
                path: ':uuid/edit',
                name: `${params.prefix}Edit`,
                meta: {
                    type: 'edit',
                    action: 'update',
                    trans: 'global.edit',
                    ...params
                },
                component: () => import('@views/Pages/Option/Action.vue'),
            }
        ],
    }
}
