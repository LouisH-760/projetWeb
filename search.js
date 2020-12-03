// regex object with both separators to do it all at once
const SPLIT = /([-\+])/g;
// both our separators for later comparison.
// if you change one, change the regex too!
const PLUSSEP = "+";
const MINUSSEP = "-";

/**
 * Retrieve the search string, parse it.
 */
function handle() {
    // searchbar trimmed value
    let inputVal = $('#searchbar').val().trim();
    // get the arguments array
    let toSend = parseArgs(inputVal);
    // TODO eplace this by sending to the backend
    // TODO replace placeholder with actual autocomplete to display
    addToAutoCompleteBox(toSend.include);
}

/**
 * Take an array of strings or whatever as input,
 * then add them as autocomplete prompts to the searchbar
 * @param {array} array 
 */
function addToAutoCompleteBox(array) {
    // remove all existing autocomplete items
    $('.autocomplete-items').remove();
    // create the container
    let a = document.createElement("DIV");
    a.setAttribute("class", "autocomplete-items");
    // attach it to the searchbar
    document.getElementById("searchbar").parentNode.appendChild(a);
    for (let val of array) {
        // create individual autocompletes
        let b = document.createElement("DIV");
        // set the value
        b.innerHTML = val;
        // make it so if one is clicked, its value is appended to the searchbar
        b.addEventListener("click", function (e) {
            $('#searchbar').val($('#searchbar').val() + this.innerHTML);
        });
        // append it to the container
        a.appendChild(b);
    }
}

/**
 * Split the search query in an object.
 * Everything after a + is an exact string to match / until the next +/-
 * Everything after a - is an exact string to not match / until the next +/-
 * @param {string} query : query to search from
 */
function parseArgs(query) {
    let tmpplus = [];
    let tmpminus = [];
    let tmpquery = [];
    let firstSplit = query.split(SPLIT);
    // go through the list. The separators (+ & -) are on their own, followed by their content
    // useful to split everything into a nice object!
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

// if the script is properly referenced in the head (with "defer"),
// then this won't run before the DOM finished loading.
// trigger autocompletion on key release and focus gained from the searchbar
$("#searchbar").keyup(handle);
// non-jQuery listen to encompass the whole DOM
document.addEventListener("click", function (e) {
    $('.autocomplete-items').remove();
});