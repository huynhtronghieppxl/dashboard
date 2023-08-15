/**
 * save cookie
 * @param key
 * @param value
 */
function saveCookieShared(key, value) {
    document.cookie = key + "=" + value;
}

/**
 * get cookie
 * @param name
 * @returns {string}
 */
function getCookieShared(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

/**
 * delete cookie by name
 * @param name
 */
function deleteCookieShared(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
