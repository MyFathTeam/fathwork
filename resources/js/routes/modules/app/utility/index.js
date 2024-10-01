import { trans } from '@core/helpers/trans'
import { getOptionRoutes } from '../option'
import todo from './todo'
import backup from './backup'
import activityLog from './activityLog'

export default [
    ...todo,
    ...backup,
    ...activityLog,
    {
        path: 'utility',
        name: 'Utility',
        redirect: { name: 'UtilityTodo' },
        meta: {
            isNotNav: true,
            label: 'utility.utility',
            icon: 'fas fa-tools',
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: 'config',
                name: 'UtilityConfig',
                redirect: { name: 'UtilityConfigGeneral' },
                meta: {
                    isNotNav: true,
                    type: 'config',
                    action: 'config',
                    trans: 'global.config',
                    label: 'config.config',
                    permissions: ['config:store']
                },
                component: () => import('@views/Pages/Utility/Config/Index.vue'),
                children: [
                    {
                        path: '',
                        name: 'UtilityConfigIndex',
                        redirect: { name: 'UtilityConfigGeneral' },
                    },
                    {
                        path: 'general',
                        name: 'UtilityConfigGeneral',
                        meta: {
                            type: 'config',
                            action: 'config',
                            trans: 'config.config',
                            label: 'config.config',
                        },
                        component: () => import('@views/Pages/Utility/Config/General.vue'),
                    },
                    getOptionRoutes({
                        path: 'todo-lists',
                        prefix: 'UtilityConfigTodoList',
                        queryType: 'todo_list',
                        label: 'utility.todo.list.list',
                        transKey: 'utility.todo.list',
                        navs: [
                            { label: trans('utility.todo.todo'), path: 'UtilityConfigTodoList' },
                            { label: trans('utility.config.config'), path: 'UtilityConfig' },
                        ]
                    }),
                ]
            },
        ]
    },
]
