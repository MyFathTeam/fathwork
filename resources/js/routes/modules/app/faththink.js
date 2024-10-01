export default [
    {
        path: 'faththinks',
        name: 'Faththink',
        redirect: { name: 'FaththinkList' },
        meta: {
            label: 'faththink.faththink',
            icon: 'fas fa-boxes',
            hideChildren: true,
            permissions: ['faththink:read']
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: 'FaththinkList',
                meta: {
                    trans: 'global.list',
                    label: 'faththink.faththink',
                },
                component: () => import('@views/Pages/Faththink/Index.vue'),
            },
        ]
    },
]
