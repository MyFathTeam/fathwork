import store from '@stores'

export default [
    {
        path: 'error',
        name: 'Error',
        meta: {
            title: 'general.errors.error_page_title',
        },
        component: () => import('@views/Pages/Errors/Index.vue'),
    },
    {
        path: '401',
        name: 'Error401',
        meta: {
            title: 'general.errors.unauthorized_title',
        },
        component: () => import('@views/Pages/Errors/401.vue'),
    },
    {
        path: '403',
        name: 'Error403',
        meta: {
            title: 'general.errors.permission_denied_title',
        },
        component: () => import('@views/Pages/Errors/403.vue'),
    },
    {
        path: '404',
        name: 'Error404',
        meta: {
            title: 'general.errors.page_not_found_title',
        },
        component: () => import('@views/Pages/Errors/404.vue'),
    },
]
