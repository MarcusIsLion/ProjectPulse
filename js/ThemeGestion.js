document.getElementById("theme").addEventListener("change", function () {
    // Récupère la valeur sélectionnée
    const selectedTheme = this.value;

    // Modifie la classe du body
    document.body.className = selectedTheme;

    //sauvegarder la sélection via une requête AJAX si nécessaire
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "post/post_ChangeTheme.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("theme=" + selectedTheme);
});

// Initialisation : applique la classe de thème au chargement de la page
document.body.className = document.getElementById("theme").value;
