// Script pour la barre de recherche, et son affichage est déjà géré
const searchBox = document.getElementById("search-box");
const errorMessage = document.getElementById("error-message");
const loaderLogo = document.getElementById("loader");
let searchTimeout; // Variable pour gérer le délai

function SearchCard() {
    // Affiche le loader pendant la recherche
    loaderLogo.style.display = "block";
    errorMessage.style.display = "none";
    const cards = document.querySelectorAll(".card");
    const searchValue = searchBox.value.toLowerCase();

    // Parse les tags et leurs valeurs dans le texte de recherche
    const nameTag = searchValue.match(/name:\s*([^;]*)/);
    const languageTag = searchValue.match(/language:\s*([^;]*)/);
    const stateTag = searchValue.match(/state:\s*([^;]*)/);
    const typeTag = searchValue.match(/type:\s*([^;]*)/);

    // Supprime les tags pour effectuer une recherche générale avec le reste
    const generalSearchValue = searchValue
        .replace(/name:\s*[^;]*/g, "")
        .replace(/language:\s*[^;]*/g, "")
        .replace(/state:\s*[^;]*/g, "")
        .replace(/type:\s*[^;]*/g, "")
        .trim();

    let found = false; // Variable pour vérifier si au moins une carte est trouvée

    for (let i = 0; i < cards.length; i++) {
        const card = cards[i];
        card.style.display = "none"; // Par défaut, on cache la carte

        const cardTitle = card
            .querySelector(".card-title")
            .textContent.toLowerCase();
        const cardLanguage = card
            .querySelector(".projectLanguage")
            .textContent.toLowerCase();
        const cardState = card
            .querySelector(".projectState")
            .textContent.toLowerCase();
        const cardType = card
            .querySelector(".ProjectType")
            .textContent.toLowerCase();

        let matches = true; // On suppose d'abord que ça correspond

        // Vérification des tags spécifiques
        if (nameTag && !cardTitle.includes(nameTag[1].trim())) {
            matches = false;
        }
        if (languageTag && !cardLanguage.includes(languageTag[1].trim())) {
            matches = false;
        }
        if (stateTag && !cardState.includes(stateTag[1].trim())) {
            matches = false;
        }
        if (typeTag && !cardType.includes(typeTag[1].trim())) {
            matches = false;
        }

        // Vérification générale (si aucune recherche spécifique n'est définie, on fait une recherche générale)
        if (
            generalSearchValue &&
            !cardTitle.includes(generalSearchValue) &&
            !cardLanguage.includes(generalSearchValue) &&
            !cardState.includes(generalSearchValue) &&
            !cardType.includes(generalSearchValue)
        ) {
            matches = false;
        }

        // Si toutes les conditions sont satisfaites, on montre la carte
        if (matches) {
            card.style.display = "block";
            found = true; // Une carte a été trouvée
        }
    }

    // Gère l'affichage de l'erreur après 0,5 seconde si aucun projet n'est trouvé
    clearTimeout(searchTimeout); // Réinitialiser le timeout précédent
    searchTimeout = setTimeout(() => {
        if (!found) {
            errorMessage.style.display = "block"; // Afficher l'alerte
            loaderLogo.style.display = "none"; // Cacher le loader
        } else {
            errorMessage.style.display = "none"; // Cacher l'alerte si des cartes sont trouvées
            loaderLogo.style.display = "none"; // Cacher le loader
        }
    }, 200); // 0,5 seconde
}

// Ajout de l'événement keyup pour la barre de recherche
searchBox.addEventListener("keyup", (e) => {
    if (
        e.key != "Control" &&
        e.key != "Alt" &&
        e.key != "Shift" &&
        e.key != "CapsLock" &&
        e.key != "AltGraph" &&
        e.key != "Enter" &&
        e.key != "ArrowUp" &&
        e.key != "ArrowDown" &&
        e.key != "ArrowLeft" &&
        e.key != "ArrowRight" &&
        e.key != "Escape" &&
        e.key != "PageUp" &&
        e.key != "PageDown" &&
        e.key != "Home" &&
        e.key != "End" &&
        e.key != "Tab" &&
        e.key != "Delete" &&
        e.key != "Insert" &&
        e.key != "ContextMenu"
    ) {
        if (e.key == "Backspace") {
            if (searchBox.value.length > 0) {
                SearchCard();
            }
        } else {
            SearchCard();
        }
    }
});
