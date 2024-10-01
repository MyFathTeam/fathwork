export default [
    {
        path: 'posts',
        name: 'Post',
        redirect: { name: 'PostList' },
        meta: {
            label: 'blog.post.post',
            icon: 'fa-solid fa-arrow-right',
            hideChildren: true,
            permissions: ['post:read']
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: 'PostList',
                meta: {
                    trans: 'global.list',
                    label: 'blog.post.post',
                },
                component: () => import('@views/Pages/Blog/Post/Index.vue'),
            },
            {
                path: 'create',
                name: 'PostCreate',
                meta: {
                    type: 'create',
                    action: 'create',
                    trans: 'global.add',
                    label: 'blog.post.post',
                    permissions: ['post:create']
                },
                component: () => import('@views/Pages/Blog/Post/Action.vue'),
            },
            {
                path: ':uuid/edit',
                name: 'PostEdit',
                meta: {
                    type: 'edit',
                    action: 'update',
                    trans: 'global.edit',
                    label: 'blog.post.post',
                    permissions: ['post:edit']
                },
                component: () => import('@views/Pages/Blog/Post/Action.vue'),
            },
            {
                path: ':uuid/duplicate',
                name: 'PostDuplicate',
                meta: {
                    type: 'duplicate',
                    action: 'create',
                    trans: 'global.duplicate',
                    label: 'blog.post.post',
                    permissions: ['post:create']
                },
                component: () => import('@views/Pages/Blog/Post/Action.vue'),
            },
            {
                path: ':uuid',
                name: 'PostShow',
                meta: {
                    trans: 'global.detail',
                    label: 'blog.post.post',
                    permissions: ['post:read']
                },
                component: () => import('@views/Pages/Blog/Post/Show.vue'),
            }
        ]
    },
]
