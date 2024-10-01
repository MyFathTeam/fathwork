export function toQueryString(url, params) {
    if (! params || _.isEmpty(params)) {
        return url
    }

    Object.keys(params).forEach(key => {
        if (params[key] === '' || params[key] == null) {
            delete params[key];
        }
    });

    let queryString = Object.keys(params).map(key => {
        return _.snakeCase(key) + '=' + params[key]
    }).join('&');

    return queryString ? (url + '?' + queryString) : url
}
