// Fonction pour récupérer et afficher les cartes
async function loadCards() {
    try {
        const response = await fetch("function/GetAllCardToCreate.php");
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        const cards = await response.json();

        // Appel à la fonction pour afficher les cartes
        try {
            displayCards(cards);
        } catch (error) {
            console.error("Erreur lors de l'affichage des cartes:", error);
        }
    } catch (error) {
        console.error("Erreur lors de la récupération des cartes:", error);
    }
}

// Fonction pour afficher les cartes
async function displayCards(cards) {
    const cardGrid = document.getElementById("VisibleCardGrid");
    cardGrid.innerHTML = ""; // Vide le contenu précédent
    let counter = 0;

    for (const cardName of Object.values(cards)) {
        counter++;
        const baseUrl = "includes/card.php";

        const params = new URLSearchParams({
            dossier: cardName,
            chemin_complet: `Projects/${cardName}`, // Correction ici
            LanguageIdPopover: counter,
        });

        const response = await fetch(`${baseUrl}?${params}`);
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        const cardHtml = await response.text();
        cardGrid.innerHTML += cardHtml;
    }
}

// Appel de la fonction pour charger les cartes
loadCards();
