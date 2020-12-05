function fillMain() {
    let login = $("#login").val();
    $.get("getFavourite.php", {"login":login}, resultHandler);
}

function resultHandler(result) {
    let parsed = new Set(JSON.parse('{"array":' + result + '}').array);
    let login = $("#login").val();
    $("main").html($("main").html() + "<ul>");
    for(let elem of parsed) {
        if (elem !== "") {
            $("main").html($("main").html() + "<li>" + linkFromId(elem) + ' - <a href="removeFavourite.php?login=' + login + '&id=' + elem + '">supprimer</a></li>');
        }
    }
    $("main").html($("main").html() + "</ul>");
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

fillMain();