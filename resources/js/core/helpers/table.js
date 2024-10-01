export const initSelected = {
    pageItems: [],
    items: [],
    all: false,
    global: false
}

export function allSelected(selected) {
    return selected.pageItems.every(elem => selected.items.includes(elem)) ? true : false
}

export function toggleSelectAll(value, selected) {
    selected.pageItems.forEach(item => {
        if (value && ! selected.items.includes(item)) {
            selected.items.push(item)
        } else if (! value) {
            selected.items.splice(selected.items.indexOf(item), 1);
        }
    })

    return selected.items
}

export function getColumnLabel(header, key) {
    let index = header.findIndex(o => o.key == key);

    if (index >=0) {
        return header[index].label
    }

    return;
}
