// Script pour la barre de recherche, et son affichage est déjà géré
const searchBox = document.getElementById("search-box");

function SearchCard() {
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
        }
    }
}

searchBox.addEventListener("keyup", (e) => {
    SearchCard();
});
