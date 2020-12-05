// regex object with both separators to do it all at once
const SPLIT = /([-\+])/g;
// both our separators for later comparison.
// if you change one, change the regex too!
const PLUSSEP = "+";
const MINUSSEP = "-";
// code de la touche entrée
const ENTER = 13;

/**
 * Handle when the search button is clicked.
 */
function clickHandle() {
    $.get("search.php", getParsedInput(), searchResultHandler);
}

/**
 * take the result of the get request in, parse it and display it
 * @param {string} results 
 */
function searchResultHandler(results) {
    let resObj = JSON.parse(results);
    let links = new Array();
    // first, get all the IDs from the answer
    for (let elem of resObj.results) {
        // this function will add the title to the links once it gets an answer from the server
        links.push(linkFromId(elem));
    }
    let disp;
    // if there are one or more links
    if (links.length >= 1) {
        // add a line for a stat and a link to clear the results
        disp = '<div class="rescom">' + links.length + ' Résultat(s). <a href="index.php">Réinitialiser la recherche</a></div>';
        // al the results are displayed as a list
        disp += "<ul><li>";
        // add all the links
        disp += links.join("</li><li>");
        disp += "</li></ul>";
        // if there are no links, show an error message
    } else {
        disp = '<div class="rescom">Aucun résultat trouvé pour votre requête</div>';
    }
    // actually display what we computed
    $("#mainContainer").html(disp);
}

/**
 * Return a link to diplay on the DOM
 * and start a request to get it the name of the cocktail as text
 * @param {string} id 
 */
function linkFromId(id) {
    // fetch the names to display them
    // This is done asynchronously.
    $.get("gettitle.php", { "id": id }, function (result) {
        $("#" + id).html(result);
    });
    // return the link with a placeholder text.
    // the text will automatically be replaced by the name of the cocktail
    // once the get request finishes
    // this should be transparent to the user
    return '<a href="afficherecette.php?id=' + id + '" id="' + id + '">Loading...</a>';
}

/**
 * Get the value of the search bar and call the parsing function
 * return the output
 */
function getParsedInput() {
    // searchbar trimmed value
    let inputVal = $('#searchbar').val().trim();
    // get the arguments array
    return parseArgs(inputVal);
}

/**
 * Retrieve the search string, parse it.
 */
function autocHandle() {
    let toSend = getParsedInput();
    // get the current category from the hidden field placed using php
    toSend.root = $("#currentVal").val();
    toSend.ingredients = new Array();
    if (toSend.include[toSend.include.length - 1] != undefined) {
        toSend.ingredients.push(toSend.include[toSend.include.length - 1]);
    }
    if(toSend.exclude[toSend.exclude.length - 1]) {
        toSend.ingredients.push(toSend.exclude[toSend.exclude.length - 1]);
    }
    $.get("autoComplete.php", toSend, autocResHandle);
}

/**
 * Get the JSON string of the autocomplete and add it to the autocomplete
 * @param {string} result 
 */
function autocResHandle(result) {
    let parsed = JSON.parse(result);
    // a set is iterable too
    // this dedupes the list.
    let ingredients = new Set(parsed.results.ingredients);
    let recettes = new Set(parsed.results.recipes);
    let autoComp = new Set([...ingredients, ...recettes]);
    // add the deduped ingredients to the autocomplete
    addToAutoCompleteBox(autoComp);
}

/**
 * What happens when you click on an autocomplete element
 * replaces the stub that the user was typing
 */
function autocPclickhandler() {
    // what do i need to add?
    let toAdd = this.innerHTML;
    // in what do i need to add it
    let searchVal = $("#searchbar").val();
    // get the pos of the first +
    let plusPos = searchVal.lastIndexOf(PLUSSEP);
    // get the pos of the first -
    let minusPos = searchVal.lastIndexOf(MINUSSEP);
    // shave everything after the latter of both signs, 
    // everything if there are nonce
    let shave = Math.max(plusPos, minusPos);
    // actual shaving
    let shaved = searchVal.substring(0, shave + 1);
    // put the value to add in after the shaved original content
    $("#searchbar").val(shaved + toAdd);
}

/**
 * Take an array of strings or whatever as input,
 * then add them as autocomplete prompts to the searchbar
 * Actually doesn't need to be an array, just iterable
 * @param {iterable} array 
 */
function addToAutoCompleteBox(array) {
    // remove all existing autocomplete items
    $('.autocomplete-items').remove();
    // create the container
    let a = document.createElement("DIV");
    a.setAttribute("class", "autocomplete-items");
    a.setAttribute("id", "autocontainer")
    // attach it to the searchbar
    document.getElementById("searchbar").parentNode.appendChild(a);
    for (let val of array) {
        // create individual autocompletes
        let b = document.createElement("DIV");
        // set the value
        b.innerHTML = val;
        b.setAttribute("class", "autoc-item");
        // make it so if one is clicked, its value is appended to the searchbar
        b.addEventListener("click", autocPclickhandler);
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
    let root = $("#currentVal").val();
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
    return { "query": tmpquery, "include": tmpplus, "exclude": tmpminus, "root": root };
}

// if the script is properly referenced in the head (with "defer"),
// then this won't run before the DOM finished loading.
// trigger autocompletion on key release and focus gained from the searchbar
$("#searchbar").keyup(autocHandle);
$("#search").click(clickHandle);
// non-jQuery listen to encompass the whole DOM
document.addEventListener("click", function (e) {
    $('.autocomplete-items').remove();
});
