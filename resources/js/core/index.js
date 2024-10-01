import * as Api from "@core/apis"
import * as Form from "@core/utils/form"
import { emitter } from "@core/utils/emitter"
import * as Cal from "@core/helpers/cal"
import { trans } from "@core/helpers/trans"

import moment from 'moment'
import momentz from 'moment-timezone'
import Toast from "vue-toastification";
import flatPickr from 'vue-flatpickr-component';
import Vue3Marquee from 'vue3-marquee'
import { VTooltip, Menu } from 'floating-vue'
import Swal from "sweetalert2";

import {
    CheckCircleIcon,
    ExclamationCircleIcon,
    XCircleIcon,
    InformationCircleIcon,
    XMarkIcon,
    EllipsisVerticalIcon,
} from "@heroicons/vue/20/solid";

const coreComponents = import.meta.globEager("@core/components/**/*.vue")

// import FormWizard from '@core/components/Forms/FormWizard'

export default app => {
    app.provide('$http', Api);
    app.provide('$form', Form);
    app.provide('$cal', Cal);
    app.provide('$trans', trans);
    app.provide('$swal', Swal);
    app.provide('moment', moment);
    app.provide('momentz', momentz);
    app.provide('emitter', emitter);

    app.config.globalProperties.$http = Api;
    app.config.globalProperties.$form = Form;
    app.config.globalProperties.$cal = Cal;
    app.config.globalProperties.$trans = trans;
    app.config.globalProperties.$swal = Swal;
    app.config.globalProperties.moment = moment;
    app.config.globalProperties.emitter = emitter;

    app.use(Toast, {
        position: "bottom-right",
        timeout: 5000,
        closeOnClick: true,
        pauseOnFocusLoss: true,
        pauseOnHover: true,
        draggable: true,
        draggablePercent: 0.6,
        showCloseButtonOnHover: false,
        hideProgressBar: true,
        closeButton: "button",
        icon: true,
        rtl: false
    })
    app.use(Vue3Marquee);

    app.directive('tooltip', VTooltip)

    Object.entries(coreComponents).forEach(([path, defnshan]) => {
        const componentName = path.split('/').pop().replace(/\.\w+$/, '')
        app.component(componentName, defnshan.default)
    })

    app.component('VMenu', Menu)
    app.component('flat-pickr', flatPickr);
    app.component('CheckCircleIcon', CheckCircleIcon)
    app.component('ExclamationCircleIcon', ExclamationCircleIcon)
    app.component('XCircleIcon', XCircleIcon)
    app.component('InformationCircleIcon', InformationCircleIcon)
    app.component('XMarkIcon', XMarkIcon)
    app.component('EllipsisVerticalIcon', EllipsisVerticalIcon)
}
