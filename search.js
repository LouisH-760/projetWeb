const SPLIT = /([-\+])/g;
const PLUSSEP = "+";
const MINUSSEP = "-";

/**
 * Retrieve the search string, parse it.
 */
function handle() {
    let inputVal = $('#searchbar').val().trim();
    let toSend = parseArgs(inputVal);
    console.log(toSend);
}

/**
 * Split the search query in an object.
 * Everything after a + is an exact string to match / until the next +/-
 * Everything after a - is an exact string to not match / until the next +/-
 * @param {*} query : query to search from
 */
function parseArgs(query) {
    let tmpplus = [];
    let tmpminus = [];
    let tmpquery = [];
    let firstSplit = query.split(SPLIT);
    for(let i = 0; i < firstSplit.length; i++) {
        if(firstSplit[i] == PLUSSEP) {
            tmpplus.push(firstSplit[i + 1].trim());
            i++;
        } else if (firstSplit[i] == MINUSSEP) {
            tmpminus.push(firstSplit[i + 1].trim());
            i++;
        } else {
            tmpquery.push(firstSplit[i].trim());
        }
    }
    return {"query":tmpquery, "include":tmpplus, "exclude":tmpminus};
}

$("#searchbar").keyup(handle);