import has from 'lodash/has'
import get from 'lodash/get'
import omit from 'lodash/omit'
import replace from 'lodash/replace'
import isArray from 'lodash/isArray'
import forEach from 'lodash/forEach'
import groupBy from 'lodash/groupBy'
import isEqual from 'lodash/isEqual'
import isEmpty from 'lodash/isEmpty'
import includes from 'lodash/includes'
import throttle from 'lodash/throttle'
import debounce from 'lodash/debounce'
import eachRight from 'lodash/eachRight'
import startCase from 'lodash/startCase'
import cloneDeep from 'lodash/cloneDeep'
import mapValues from 'lodash/mapValues'
import snakeCase from 'lodash/snakeCase'
import camelCase from 'lodash/camelCase'
import isPlainObject from 'lodash/isPlainObject'

window._ = {
    'has': has,
    'get': get,
    'omit': omit,
    'replace': replace,
    'isEqual': isEqual,
    'isEmpty': isEmpty,
    'forEach': forEach,
    'isArray': isArray,
    'groupBy': groupBy,
    'includes': includes,
    'throttle': throttle,
    'debounce': debounce,
    'eachRight': eachRight,
    'camelCase': camelCase,
    'snakeCase': snakeCase,
    'mapValues': mapValues,
    'startCase': startCase,
    'cloneDeep': cloneDeep,
    'isPlainObject': isPlainObject,
}
