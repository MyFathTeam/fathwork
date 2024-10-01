import momentz from 'moment-timezone'
import store from '@stores'

export function toUserTimezone(datetime, type = 'date') {
    if (! datetime) {
        return
    }

    const config = store.getters["config/config"]('system')
    const preference = store.getters["auth/user/user"]('preference.system')

    const timezone = preference.timezone || config.timezone
    const dateFormat = preference.dateFormat || config.dateFormat
    const timeFormat = preference.timeFormat || config.timeFormat

    if (type === 'date') {
        return momentz.utc(datetime).tz(timezone).format(dateFormat)
    } else if (type === 'time') {
        return momentz.utc(datetime).tz(timezone).format(timeFormat)
    } else if (type === 'datetime') {
        return momentz.utc(datetime).tz(timezone).format(dateFormat+' '+timeFormat)
    }
}