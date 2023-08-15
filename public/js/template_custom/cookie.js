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
    document.cookie = name +`=; Path=/; Expires=${Date()}`;
}

function saveCookieOneDay(key, value) {
    key = 'cookie-one-day' + moment().format("MM-DD-YYYY") + key
    document.cookie = `${key}"="${value};expires=${Date()}`;
    return key;
}

/**
 * save session by name
 * @param name
 */
function setItemSessionTemplate(name, value) {
    sessionStorage.setItem(name, value)
}

/**
 * get session by name
 * @param name
 */
function getItemSessionTemplate(name) {
    let session = sessionStorage.getItem(name)
    return session;
}

/**
 * remove session by name
 * @param name
 */
function removeItemSessionTemplate(name) {
    sessionStorage.removeItem(name)
}
