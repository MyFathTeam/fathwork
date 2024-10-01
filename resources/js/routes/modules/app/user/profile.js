export default [
    {
        path: 'user',
        name: 'Profile',
        redirect: { name: 'UserProfile' },
        meta: {
            label: 'user.profile.profile',
            icon: 'fas fa-user',
            isHiddenNav: false,
            showOnlyChildren: true,
            hideChildren: false,
        },
        component: () => import('@views/Layouts/User.vue'),
        children: [
            {
                path: 'profile',
                name: 'UserProfile',
                meta: {
                    label: 'user.profile.profile',
                    icon: 'fas fa-user-circle',
                    isHiddenNav: false,
                },
                component: () => import('@views/Pages/User/Profile/Index.vue'),
            },
            {
                path: 'account',
                name: 'UserAccount',
                meta: {
                    label: 'user.profile.account',
                    icon: 'fas fa-user',
                    isHiddenNav: false,
                },
                component: () => import('@views/Pages/User/Profile/Account.vue'),
            },
            {
                path: 'avatar',
                name: 'UserAvatar',
                meta: {
                    label: 'user.avatar',
                    icon: 'fas fa-camera',
                    isHiddenNav: false,
                },
                component: () => import('@views/Pages/User/Profile/Avatar.vue'),
            },
            {
                path: 'preference',
                name: 'UserPreference',
                meta: {
                    label: 'user.preference.preference',
                    icon: 'fas fa-user-cog',
                    isHiddenNav: false,
                },
                component: () => import('@views/Pages/User/Profile/Preference.vue'),
            },
            {
                path: 'password',
                name: 'UserPassword',
                meta: {
                    label: 'auth.password.change_password',
                    icon: 'fas fa-key',
                    isHiddenNav: false,
                },
                component: () => import('@views/Pages/User/Profile/Password.vue'),
            },
        ]
    }
]
