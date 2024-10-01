export default [
    {
        path: 'dashboard',
        name: 'Dashboard',
        meta: {
            noPadding: true,
            label: 'dashboard.dashboard',
            icon: 'fas fa-home'
        },
        component: () => import('@views/Pages/Dashboard/Index.vue'),
    },
]
