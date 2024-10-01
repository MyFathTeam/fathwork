import { computed } from "vue"
import store from '@stores'
import { cloneDeep } from "@core/utils"

export function getFormErrors(initUrl) {
    return computed(() => store.getters[initUrl + "getFormErrors"]);
}

export function getConfig(config) {
    return computed(() => store.getters['config/config'](config));
}

export function getAuthUser(key) {
    return computed(() => store.getters['auth/user/user'](key));
}

export function isSuperAdmin(key) {
    return computed(() => store.getters['auth/user/isSuperAdmin']);
}

export function resetForm(form, initForm) {
    Object.assign(form, cloneDeep(initForm))
}

export function perform(permission, type = null) {
    if (type == 'any') {
        return store.getters['auth/user/hasAnyPermission'](permission)
    } else if (type == 'all') {
        return store.getters['auth/user/hasAllPermission'](permission)
    }

    return store.getters['auth/user/hasPermission'](permission)
}

export function actingAs(role, type = null) {
    if (type == 'any') {
        return store.getters['auth/user/hasAnyRole'](role)
    } else if (type == 'all') {
        return store.getters['auth/user/hasAllRole'](role)
    }

    return store.getters['auth/user/hasRole'](role)
}
