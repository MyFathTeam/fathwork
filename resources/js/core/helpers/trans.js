import '@core/utils/lodash'

export function trans(string, args) {
    let value = _.get(window.i18n, string);

    _.eachRight(args, (prmVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, prmVal);
    });
    return value;
}

export function hasTrans(string, args) {
    let value = _.get(window.i18n, string);

    _.eachRight(args, (prmVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, prmVal);
    });

    return value === undefined ? false : true;
}
