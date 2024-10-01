export function listenPrivate(channel, eventName, callback) {
    if (! window.Echo) {
        return;
    }

    window.Echo.private(channel).listen('.' + eventName, (e) => {
        callback(e)
    });
}
