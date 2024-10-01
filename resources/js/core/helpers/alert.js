import Swal from 'sweetalert2'
import { trans } from "@core/helpers/trans"

export async function confirmDelete(desc = '') {
    return Swal.fire({
        icon: "warning",
        title: trans('general.alerts.title'),
        text: desc || trans('general.alerts.delete_description'),
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        return result.isConfirmed ? true : false
    });
}

export async function confirmAction(desc = '') {
    return Swal.fire({
        icon: "warning",
        title: trans('general.alerts.title'),
        text: desc || trans('general.alerts.description'),
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        return result.isConfirmed ? true : false
    });
}

export async function confirmReset(desc = '') {
    return Swal.fire({
        icon: "warning",
        title: trans('general.alerts.title'),
        text: desc || trans('general.alerts.reset_description'),
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        return result.isConfirmed ? true : false
    });
}
