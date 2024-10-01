export default [
    {
        path: 'locale',
        name: 'ConfigLocale',
        redirect: { name: 'ConfigLocaleList' },
        meta: {
            label: 'config.locale.locale',
            icon: 'fas fa-language',
            hideChildren: true,
            key: 'locale'
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: 'ConfigLocaleList',
                meta: {
                    trans: 'global.list',
                    label: 'config.locale.locale',
                },
                component: () => import('@views/Pages/Config/Locale/Index.vue'),
            },
            {
                path: 'create',
                name: 'ConfigLocaleCreate',
                meta: {
                    type: 'create',
                    action: 'create',
                    trans: 'global.add',
                    label: 'config.locale.locale',
                },
                component: () => import('@views/Pages/Config/Locale/Action.vue'),
            },
            {
                path: ':uuid/edit',
                name: 'ConfigLocaleEdit',
                meta: {
                    type: 'edit',
                    action: 'update',
                    trans: 'global.edit',
                    label: 'config.locale.locale',
                },
                component: () => import('@views/Pages/Config/Locale/Action.vue'),
            },
        ]
    }
]
