const SPLIT = /([-\+])/g;
const PLUSSEP = "+";
const MINUSSEP = "-";

/**
 * Retrieve the search string, parse it.
 */
function handle() {
    let inputVal = $('#searchbar').val().trim();
    let toSend = parseArgs(inputVal);
    // replace this by sending to the backend
    console.log(toSend);
    // replace placeholder with actual autocomplete to display
    addToAutoCompleteBox(toSend.include);
}

function addToAutoCompleteBox(array) {
    // remove all existing autocomplete items
    $('.autocomplete-items').remove();
    let a = document.createElement("DIV");
    a.setAttribute("class", "autocomplete-items");
    document.getElementById("searchbar").parentNode.appendChild(a);
    for (let val of array) {
        let b = document.createElement("DIV");
        b.innerHTML = val;
        b.addEventListener("click", function (e) {
            $('#searchbar').val($('#searchbar').val() + this.innerHTML);
        });
        a.appendChild(b);
    }
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
    for (let i = 0; i < firstSplit.length; i++) {
        if (firstSplit[i] == PLUSSEP) {
            tmpplus.push(firstSplit[i + 1].trim());
            i++;
        } else if (firstSplit[i] == MINUSSEP) {
            tmpminus.push(firstSplit[i + 1].trim());
            i++;
        } else {
            tmpquery.push(firstSplit[i].trim());
        }
    }
    return { "query": tmpquery, "include": tmpplus, "exclude": tmpminus };
}

$("#searchbar").keyup(handle);
document.addEventListener("click", function(e) {
    $('.autocomplete-items').remove();
});