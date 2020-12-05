$("#addFav").click(addFavClickHandler)

/**
 * Callback for when the return code for the addition is received
 * @param {*} result 
 */
function returnHandler(result) {
    if (result == 1) {
        $("#addfav").prop("disabled", true);
        alert("La recette a bien été ajoutée au favoris!");
    } else {
        alert("Erreur lors de l'ajout au favoris. Êtes-vous bien connecté?");
    }
}

/**
 * Handle a click on the add to favourites button
 */
function addFavClickHandler() {
    let id = $("#id").val();
    let login = $("#login").val();
    $.get("addFavourite.php", { "login": login, "id": id }, returnHandler);
}