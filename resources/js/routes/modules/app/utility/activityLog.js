export default [
    {
        path: 'activity-logs',
        name: 'UtilityActivityLog',
        meta: {
            label: 'utility.activity.log',
            icon: 'far fa-file-alt',
            permissions: ['activity-log:manage'],
            feature: 'enableActivityLog',
        },
        component: () => import('@views/Pages/Utility/ActivityLog/Index.vue'),
    },
]
