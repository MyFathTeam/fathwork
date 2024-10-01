import '@js/bootstrap'
import '@sass/app.scss'
import '@plugins/css/plugins.scss'

import router from "@routes"
import store from "@stores"

import { createApp, computed } from "vue"
const app = createApp({});

app.use(router);
app.use(store);

import core from './core'
core(app)

import components from '@js/components'
components(app)

app.mount("#root");
