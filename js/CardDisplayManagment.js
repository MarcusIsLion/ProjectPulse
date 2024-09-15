let NumberOfProjects = 0;
let projectsCompleted = 0; // Nombre de projets terminés

// Fonction pour mettre à jour la barre de progression
function updateProgressBar() {
    const progressBar = document.getElementById("ProgressionBarInner");
    const ContainerProgressBar = document.getElementById("ProgressionBar");

    // Vérifiez que l'élément existe avant de modifier son style
    if (!progressBar) {
        console.error("ProgressBarInner not found");
        return;
    }

    const progressPercentage = (projectsCompleted / NumberOfProjects) * 100;
    progressBar.style.width = progressPercentage + "%";

    // Mettre à jour le texte à l'intérieur de la barre de progression
    progressBar.innerText = `Charging all projects : ${projectsCompleted}/${NumberOfProjects}`;

    if (progressPercentage === 100) {
        progressBar.style.backgroundColor = "#02bd02";
        progressBar.innerText = "Charging completed, great development !";
        setTimeout(() => {
            const progressBarContainer = document.getElementById(
                "ProgressBarContener"
            );
            // Supprimer la barre de progression une fois que tous les projets sont terminés avec le style opacity à 0
            progressBarContainer.style.opacity = 0;
        }, 1000);
    }
}

// Fonction pour récupérer et afficher les cartes
async function loadCards() {
    try {
        const response = await fetch("function/GetAllCardToCreate.php");
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        const cards = await response.json();

        // On récupère le nombre de cartes à créer
        NumberOfProjects = Object.keys(cards).length;

        // Initialiser la barre de progression à 0%
        updateProgressBar();

        // Appel à la fonction pour afficher les cartes en parallèle
        try {
            await displayCards(cards);
        } catch (error) {
            console.error("Error when generating cards :", error);
        }
    } catch (error) {
        console.error("Error to get cards :", error);
    }
}

// Fonction pour afficher les cartes en parallèle
async function displayCards(cards) {
    const VisibleCardGrid = document.getElementById("VisibleCardGrid");
    const HiddenCardGrid = document.getElementById("HiddenCardGrid");
    const cardPromises = Object.values(cards).map(async (cardName, index) => {
        const responseJsonFile = await fetch(
            `function/GetJsonFromFile2.php?path=../Projects/${cardName}/type.json`
        );
        const jsonAwait = await responseJsonFile.text();
        const responsePhp = await fetch(
            `includes/card.php?dossier=${cardName}&chemin_complet=../Projects/${cardName}&LanguageIdPopover=${
                index + 1
            }&typeData=${jsonAwait}`
        );
        if (!responsePhp.ok) {
            throw new Error("Network response was not ok");
        }
        const cardHtml = await responsePhp.text();

        if (jsonAwait) {
            const decr = JSON.parse(jsonAwait);
            if (decr["visual"] == "visible") {
                // Ajouter le contenu de la carte à la grille
                VisibleCardGrid.innerHTML += cardHtml;
            } else {
                // Ajouter le contenu de la carte à la grille
                HiddenCardGrid.innerHTML += cardHtml;
            }
        } else {
            // Ajouter le contenu de la carte à la grille
            HiddenCardGrid.innerHTML += cardHtml;
        }
        // On incrémente le nombre de projets complétés après chaque carte créée
        projectsCompleted++;
        updateProgressBar(); // Mettre à jour la barre de progression après chaque projet
    });

    // Attendre que toutes les cartes soient traitées
    await Promise.all(cardPromises);
}

// Appel de la fonction pour charger les cartes
loadCards();
