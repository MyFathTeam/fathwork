import { keysToCamel } from '@core/utils/helper'
import { useToast } from 'vue-toastification'

const toast = useToast()

export function assignErrors(errors){
    return _.mapValues(errors, (errorArray) => {
        return errorArray.join(" ")
    })
}

export function handleErrors(data){
    const toReturn = data.errors ? keysToCamel(assignErrors(data.errors)) : {}

    if (data.hasOwnProperty('response_status')) {
        let status = data.response_status;

        if (data.hasOwnProperty('reload') && data.reload === true) {
            location.reload()
        }
    }

    if(Object.keys(toReturn).length) {
        if (toReturn.message) {
            toast.error(toReturn.message)
        } else {
            // toast.error(window.i18n.general.errors.something_wrong_with_form)
        }
        return toReturn
    }

    if (data.message) {
        toast.error(data.message)
    }

    return toReturn
}

export function getErrors(e) {
    return Object.assign({}, handleErrors(e))
}

export function hideLoader(payload) {
    if (payload && payload.loader) {
        payload.loader.hide()
    }
}
