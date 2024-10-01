export default [
    {
        path: 'products',
        name: 'Product',
        redirect: { name: 'ProductList' },
        meta: {
            label: 'master.product.product',
            icon: 'fa-solid fa-arrow-right',
            hideChildren: true,
            permissions: ['product:read']
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: 'ProductList',
                meta: {
                    trans: 'global.list',
                    label: 'master.product.product',
                },
                component: () => import('@views/Pages/Master/Product/Index.vue'),
            },
            {
                path: 'create',
                name: 'ProductCreate',
                meta: {
                    type: 'create',
                    action: 'create',
                    trans: 'global.add',
                    label: 'master.product.product',
                    permissions: ['product:create']
                },
                component: () => import('@views/Pages/Master/Product/Action.vue'),
            },
            {
                path: ':uuid/edit',
                name: 'ProductEdit',
                meta: {
                    type: 'edit',
                    action: 'update',
                    trans: 'global.edit',
                    label: 'master.product.product',
                    permissions: ['product:edit']
                },
                component: () => import('@views/Pages/Master/Product/Action.vue'),
            },
            {
                path: ':uuid/duplicate',
                name: 'ProductDuplicate',
                meta: {
                    type: 'duplicate',
                    action: 'create',
                    trans: 'global.duplicate',
                    label: 'master.product.product',
                    permissions: ['product:create']
                },
                component: () => import('@views/Pages/Master/Product/Action.vue'),
            },
            {
                path: ':uuid',
                name: 'ProductShow',
                meta: {
                    trans: 'global.detail',
                    label: 'master.product.product',
                    permissions: ['product:read']
                },
                component: () => import('@views/Pages/Master/Product/Show.vue'),
            }
        ]
    },
]
