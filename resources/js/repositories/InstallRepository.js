import * as Api from "@core/apis"
import * as Form from "@core/utils/form"

export function fetchPreRequisite () {
    return Api.custom({
        url: '/install/pre-requisite',
        method: 'GET'
    }).catch(error => {
        Form.getErrors(error);
    })
}

export function validatePreRequisite(preRequisites) {
    let serverError = preRequisites
    .find((preRequisite) => preRequisite.key === "server")
    .items.findIndex((item) => item.type === "error");

    if (serverError >= 0) {
        return false;
    }

    let folderError = preRequisites
        .find((preRequisite) => preRequisite.key === "folder")
        .items.findIndex((item) => item.type === "error");

    if (folderError >= 0) {
        return false;
    }

    return true;
}
