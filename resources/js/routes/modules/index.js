/* Layouts */
const BlankLayout = () => import("@views/Layouts/Blank.vue");
const AppLayout = () => import("@views/Layouts/App.vue");
const GuestLayout = () => import("@views/Layouts/Guest.vue");
const SetupLayout = () => import("@views/Layouts/Setup.vue");
const EmptyLayout = () => import("@views/Layouts/Empty.vue");
const ErrorLayout = () => import("@views/Layouts/Error.vue");

import blankRoutes from '@routes/modules/blank'
import appRoutes from '@routes/modules/app'
import guestRoutes from '@routes/modules/guest'
import setupRoutes from '@routes/modules/setup'
import emptyRoutes from '@routes/modules/empty'
import errorRoutes from '@routes/modules/error'

export default [
    {
        path: '/',
        name: 'Guest',
        component: GuestLayout,
        redirect: { name: 'Login' },
        meta: {
            isNotNav: true,
            belongsTo: 'guest',
        },
        children: [
            ...guestRoutes,
        ]
    },
    {
        path: '/',
        name: 'Blank',
        component: BlankLayout,
        meta: {
            isNotNav: true,
            belongsTo: 'blank',
        },
        children: [
            ...blankRoutes,
        ]
    },
    {
        path: '/',
        name: 'Empty',
        component: EmptyLayout,
        meta: {
            isNotNav: true,
            belongsTo: 'auth',
        },
        children: [
            ...emptyRoutes,
        ]
    },
    {
        path: '/',
        name: 'App',
        component: AppLayout,
        redirect: { name: 'Dashboard' },
        meta: {
            belongsTo: 'auth',
        },
        children: [
            ...appRoutes,
        ]
    },
    {
        path: '/',
        name: 'Setup',
        component: SetupLayout,
        redirect: { name: 'install' },
        meta: {
            isNotNav: true,
            belongsTo: 'setup',
        },
        children: [
            ...setupRoutes,
        ]
    },
    {
        path: '/',
        name: 'Error',
        component: ErrorLayout,
        meta: {
            isNotNav: true,
            belongsTo: 'setup',
        },
        children: [
            ...errorRoutes,
        ]
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        meta: {
            isNotNav: true,
        },
        beforeEnter: (to, from, next) => {
            next({ name: 'Error404', replace: true, query: { 'ref': to.fullPath, 'from': from.fullPath } })
        }
    }
];
