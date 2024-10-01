export default [
    {
        path: 'backups',
        name: 'UtilityBackup',
        meta: {
            label: 'utility.backup.backup',
            icon: 'fas fa-database',
            permissions: ['backup:manage'],
            feature: 'enableBackup',
        },
        component: () => import('@views/Pages/Utility/Backup/Index.vue'),
    },
]
