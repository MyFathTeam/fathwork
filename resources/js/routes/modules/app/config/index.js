import mailTemplate from './mailTemplate'
import locale from './locale'
import role from './role'
import permission from './permission'

export default [
    {
        path: 'config',
        name: 'Config',
        redirect: { name: 'ConfigGeneral' },
        meta: {
            label: 'config.config',
            icon: 'fas fa-cog',
            permissions: ['config:store'],
            isHiddenNav: false,
            hideChildren: false,
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: 'general',
                name: 'ConfigGeneral',
                meta: {
                    label: 'config.general.general',
                    icon: 'far fa-building',
                    key: 'general'
                },
                component: () => import('@views/Pages/Config/General/Index.vue'),
            },
            {
                path: 'asset',
                name: 'ConfigAsset',
                meta: {
                    label: 'config.asset.asset',
                    icon: 'far fa-images',
                    key: 'asset'
                },
                component: () => import('@views/Pages/Config/Asset/Index.vue'),
            },
            {
                path: 'system',
                name: 'ConfigSystem',
                meta: {
                    label: 'config.system.system',
                    icon: 'fas fa-cogs',
                    key: 'system'
                },
                component: () => import('@views/Pages/Config/System/Index.vue'),
            },
            {
                path: 'auth',
                name: 'ConfigAuth',
                meta: {
                    label: 'config.auth.auth',
                    icon: 'fas fa-sign-in-alt',
                    key: 'auth'
                },
                component: () => import('@views/Pages/Config/Auth/Index.vue'),
            },
            {
                path: 'mail',
                name: 'ConfigMail',
                meta: {
                    label: 'config.mail.mail',
                    icon: 'fas fa-envelope',
                    key: 'mail'
                },
                component: () => import('@views/Pages/Config/Mail/Index.vue'),
            },
            ...mailTemplate,
            {
                path: 'feature',
                name: 'ConfigFeature',
                meta: {
                    label: 'config.feature.feature',
                    icon: 'fas fa-boxes',
                    key: 'feature'
                },
                component: () => import('@views/Pages/Config/Feature/Index.vue'),
            },
            {
                path: 'notification',
                name: 'ConfigNotification',
                meta: {
                    label: 'config.notification.notification',
                    icon: 'fas fa-bell',
                    key: 'notification'
                },
                component: () => import('@views/Pages/Config/Notification/Index.vue'),
            },
            {
                path: 'social-network',
                name: 'ConfigSocialNetwork',
                meta: {
                    label: 'config.social.social',
                    icon: 'fas fa-share-alt',
                    key: 'social-network'
                },
                component: () => import('@views/Pages/Config/SocialNetwork/Index.vue'),
            },
            ...role,
            ...permission,
            ...locale
        ]
    }
]
