import Hashids from 'hashids';

/**
 * Remove trailing slash
 * @param string
 * @returns {string}
 */
export function removeTrailingSlash(string) {
    return string.substring(string.length -1, string.length) === '/' ? string.substring(0, string.length-1) : string;
}

/**
 * Get screen width
 */
export function getScreenWidth() {
    var w = window,
        d = document,
        e = d.documentElement,
        g = d.getElementsByTagName('body')[0],
        x = w.innerWidth || e.clientWidth || g.clientWidth,
        y = w.innerHeight|| e.clientHeight|| g.clientHeight;
    return x;
}

var hashids = new Hashids('pNbx7W4vB2D6MZ0rKRAozOryjYVJ9L31',
    6, 'abcdefghijklmnopqrstuvwxyz1234567890');

export function encodeHashId(id) {
    return hashids.encode(id);
}

export function decodeHashId(hash) {
    return parseInt(hashids.decode(hash).join(''));
}