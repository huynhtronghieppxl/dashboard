/**
 * @param arr1: array need compare
 * @param arr2: array using compare
 * @param key1: key compare
 * @param key2: key compare
 */
async function compareTwoArrayDiffTemplate(arr1, arr2, key1, key2) {
    return await arr1.filter(o1 => !arr2.some(o2 => o1.key1 === o2.key2));
}

function rateTemplate(numerator, denominator) {
    let rate;
    if (numerator === 0 && denominator === 0) {
        rate = 0;
    } else if (denominator === 0) {
        rate = 100;
    } else {
        rate = ((numerator / denominator) * 100);
    }
    return rate;
}
