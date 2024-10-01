export default [
    {
        path: 'todos',
        name: 'UtilityTodo',
        redirect: { name: 'UtilityTodoList' },
        meta: {
            label: 'utility.todo.todo',
            icon: 'far fa-check-square',
            hideChildren: true,
            permissions: ['todo:manage'],
            feature: 'enableTodo',
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: 'UtilityTodoList',
                meta: {
                    trans: 'global.list',
                    label: 'utility.todo.todos',
                },
                component: () => import('@views/Pages/Utility/Todo/Index.vue'),
            },
            {
                path: 'create',
                name: 'UtilityTodoCreate',
                meta: {
                    type: 'create',
                    action: 'create',
                    trans: 'global.add',
                    label: 'utility.todo.todo',
                },
                component: () => import('@views/Pages/Utility/Todo/Action.vue'),
            },
            {
                path: ':uuid/edit',
                name: 'UtilityTodoEdit',
                meta: {
                    type: 'edit',
                    action: 'update',
                    trans: 'global.edit',
                    label: 'utility.todo.todo',
                },
                component: () => import('@views/Pages/Utility/Todo/Action.vue'),
            },
            {
                path: ':uuid/duplicate',
                name: 'UtilityTodoDuplicate',
                meta: {
                    type: 'duplicate',
                    action: 'create',
                    trans: 'global.duplicate',
                    label: 'utility.todo.todo',
                },
                component: () => import('@views/Pages/Utility/Todo/Action.vue'),
            },
            {
                path: ':uuid',
                name: 'UtilityTodoShow',
                meta: {
                    trans: 'global.detail',
                    label: 'utility.todo.todo',
                },
                component: () => import('@views/Pages/Utility/Todo/Show.vue'),
            }
        ]
    },
]
