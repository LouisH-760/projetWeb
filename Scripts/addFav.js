$("#addFav").click(function () {
    let id = $("#id").val();
    let login = $("#login").val();
    $.get("addFavourite.php", { "login": login, "id": id }, returnHandler);
})

function returnHandler(result) {
    if (result == 1) {
        $("#addfav").prop("disabled", true);
        alert("La recette a bien été ajoutée au favoris!");
    } else {
        alert("Erreur lors de l'ajout au favoris. Êtes-vous bien connecté?");
    }
}