import request from "./init"
import { toQueryString } from "@core/helpers/array"

export function list(url, params = {}) {
    return request({
        url: toQueryString(url, params),
        method: 'get',
    })
}

export function store(url, data, params = {}) {
    return request({
        url: toQueryString(url, params),
        method: 'post',
        data
    })
}

export function get(url, id, params = {}) {
    return request({
        url: toQueryString(`${url}/${id}`, params),
        method: 'get'
    })
}

export function update(url, id, data, params = {}) {
    return request({
        url: toQueryString(`${url}/${id}`, params),
        method: 'patch',
        data
    })
}

export function destroy(url, id, params = {}) {
    return request({
        url: toQueryString(`${url}/${id}`, params),
        method: 'delete',
    })
}

export function custom(options) {
    return request(options)
}
