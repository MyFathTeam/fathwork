import { cloneDeep } from "@core/utils"

const toCamel = (s) => {
    return s.replace(/([-_][a-z])/ig, ($1) => {
      return $1.toUpperCase()
        .replace('-', '')
        .replace('_', '');
    });
};

export function isPromise (func) {
  return func.then && typeof func.then === 'function'
}

const isArray = function (a) {
    return Array.isArray(a);
};

const isObject = function (o) {
    return o === Object(o) && !isArray(o) && typeof o !== 'function';
};

export function keysToCamel(obj) {
    let newObj = cloneDeep(obj)
    return keysToCamelCase(newObj)
}

const keysToCamelCase = function (obj) {
    if (isObject(obj)) {
        const n = {};

        Object.keys(obj)
        .forEach((k) => {
            n[toCamel(k)] = keysToCamelCase(obj[k]);
        });

        return n;
    } else if (isArray(obj)) {
        return obj.map((i) => {
        return keysToCamelCase(i);
        });
    }

    return obj;
}

export function keysToSnake(obj) {
    let newObj = cloneDeep(obj)
    return keysToSnakeCase(newObj)
}

const keysToSnakeCase = function (obj) {
    if (typeof(obj) != "object") return obj;

    for(var oldName in obj){

        let newName = oldName.replace(/([A-Z])/g, function($1){return "_"+$1.toLowerCase();});

        if (newName != oldName) {
            if (obj.hasOwnProperty(oldName)) {
                obj[newName] = obj[oldName];
                delete obj[oldName];
            }
        }

        if (typeof(obj[newName]) == "object") {
            obj[newName] = keysToSnakeCase(obj[newName]);
        }

    }
    return obj;
}
