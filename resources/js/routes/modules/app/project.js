export default [
    {
        path: 'projects',
        name: 'Project',
        redirect: { name: 'ProjectList' },
        meta: {
            label: 'project.project',
            icon: 'fas fa-boxes',
            hideChildren: true,
            permissions: ['project:read']
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: 'ProjectList',
                meta: {
                    trans: 'global.list',
                    label: 'project.projects',
                },
                component: () => import('@views/Pages/Project/Index.vue'),
            },
            {
                path: 'create',
                name: 'ProjectCreate',
                meta: {
                    type: 'create',
                    action: 'create',
                    trans: 'global.add',
                    label: 'project.project',
                    permissions: ['project:create']
                },
                component: () => import('@views/Pages/Project/Action.vue'),
            },
            {
                path: ':uuid/edit',
                name: 'ProjectEdit',
                meta: {
                    type: 'edit',
                    action: 'update',
                    trans: 'global.edit',
                    label: 'project.project',
                    permissions: ['project:edit']
                },
                component: () => import('@views/Pages/Project/Action.vue'),
            },
            {
                path: ':uuid/duplicate',
                name: 'ProjectDuplicate',
                meta: {
                    type: 'duplicate',
                    action: 'create',
                    trans: 'global.duplicate',
                    label: 'project.project',
                    permissions: ['project:create']
                },
                component: () => import('@views/Pages/Project/Action.vue'),
            },
            {
                path: ':uuid',
                name: 'ProjectShow',
                meta: {
                    trans: 'global.detail',
                    label: 'project.project',
                    permissions: ['project:read']
                },
                component: () => import('@views/Pages/Project/Show.vue'),
            }
        ]
    },
]
