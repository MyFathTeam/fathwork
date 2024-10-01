export default [
    {
        path: 'mail-template',
        name: 'ConfigMailTemplate',
        redirect: { name: 'ConfigMailTemplateList' },
        meta: {
            label: 'config.mail.template.template',
            icon: 'fas fa-file-lines',
            hideChildren: true,
            key: 'mailTemplate'
        },
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                path: '',
                name: 'ConfigMailTemplateList',
                meta: {
                    trans: 'global.list',
                    label: 'config.mail.template.template',
                },
                component: () => import('@views/Pages/Config/MailTemplate/Index.vue'),
            },
            {
                path: ':uuid/edit',
                name: 'ConfigMailTemplateEdit',
                meta: {
                    type: 'edit',
                    action: 'update',
                    trans: 'global.edit',
                    label: 'config.mail.template.template',
                },
                component: () => import('@views/Pages/Config/MailTemplate/Action.vue'),
            },
            {
                path: ':uuid',
                name: 'ConfigMailTemplateShow',
                meta: {
                    trans: 'global.detail',
                    label: 'config.mail.template.template',
                },
                component: () => import('@views/Pages/Config/MailTemplate/Show.vue'),
            },
        ]
    }
]
