export function random(length) {
    var result = "";
    var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(
            Math.floor(Math.random() * charactersLength)
        );
    }
    return result;
}

export function toBoolean(value) {
    if (typeof value === 'number') {
        return value ? true : false
    } else if (typeof value === 'string') {
        if (! value) {
            return false
        }
        return value.toLowerCase() === 'false' ? false : true
    }
    return value
}

export function nl2br (str, replaceMode, isXhtml) {
    var breakTag = (isXhtml) ? '<br />' : '<br>';
    var replaceStr = (replaceMode) ? '$1'+ breakTag : '$1'+ breakTag +'$2';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
}

export function br2nl (str, replaceMode) {
    var replaceStr = (replaceMode) ? "\n" : '';
    return str.replace(/<\s*\/?br\s*[\/]?>/gi, replaceStr);
}
