export function cloneDeep (input) {
    let output, value, key

    if (typeof input !== "object" || input === null) {
      return input
    }

    output = Array.isArray(input) ? [] : {}

    for (key in input) {
      value = input[key]

      output[key] = cloneDeep(value)
    }

    return output
}

export function emptyObject(obj) {
    Object.keys(obj).forEach(k => delete obj[k])
}
