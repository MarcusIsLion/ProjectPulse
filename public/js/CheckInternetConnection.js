/**
 * Fonction pour vérifier si il existe une connexion internet
 * @returns {boolean} true si connexion valide, false dans le cas contraire
 */
function isInternetAvailable() {
    return navigator.onLine;
}

/**
 * Fonction asynchrone pour vérifier les versions entre le fichier distant et le fichier local.
 * @return {Promise<boolean>} Retourne true si les versions correspondent, sinon false.
 */
async function CheckVersions() {
    try {
        // URL du fichier version.json sur GitHub (brut)
        const githubJsonUrl =
            "https://raw.githubusercontent.com/MarcusIsLion/ProjectPulse/main/data/version.json";

        // Récupérer la version du fichier JSON distant (GitHub)
        const githubData = await getJsonFromUrl(githubJsonUrl);
        const githubVersion = githubData.version;

        // Récupérer la version du fichier JSON local depuis le fichier dans le dossier "data"
        const localData = await getJsonFromLocalFile(); // Utilisation de la fonction correcte
        const localVersion = localData ? localData.version : null;

        // Comparer les versions
        return githubVersion === localVersion;
    } catch (error) {
        console.error(
            "Erreur lors de la vérification des versions :",
            error.message
        );
        return false;
    }
}

/**
 * Fonction asynchrone pour récupérer un fichier JSON à partir d'une URL.
 * @param {string} url L'URL du fichier JSON.
 * @return {Promise<Object>} Retourne les données JSON sous forme d'objet.
 */
async function getJsonFromUrl(url) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(
                `Erreur lors de la récupération des données : ${response.statusText}`
            );
        }
        return await response.json();
    } catch (error) {
        console.error("Erreur dans getJsonFromUrl :", error.message);
        throw error;
    }
}

/**
 * Fonction pour récupérer un fichier JSON local situé dans le dossier "data".
 * @return {Promise<Object|null>} Retourne les données JSON stockées ou null si elles n'existent pas.
 */
async function getJsonFromLocalFile() {
    try {
        const response = await fetch("../data/version.json"); // Chemin relatif vers le fichier
        if (!response.ok) {
            throw new Error(
                `Erreur lors de la récupération des données locales : ${response.statusText}`
            );
        }
        return await response.json();
    } catch (error) {
        console.error("Erreur dans getJsonFromLocalFile :", error.message);
        return null;
    }
}

// Gestion des éléments DOM
const NoInternetDiv = document.getElementById("NoInternetDiv");
const GitHubIssueDiv = document.getElementById("GitHubIssueDiv");
const GitHubDiv = document.getElementById("GitHubDiv");
const UpdateBadgeDiv = document.getElementById("VersionBadgeDiv");

/**
 * Fonction pour gérer l'affichage des badges en fonction de la connexion et des versions
 */
async function ManageBadges() {
    const isInternet = isInternetAvailable();
    if (isInternet) {
        NoInternetDiv.style.display = "none";
        GitHubIssueDiv.style.display = "block";
        GitHubDiv.style.display = "block";

        const isUpdated = await CheckVersions(); // Utiliser await pour attendre la réponse
        if (!isUpdated) {
            UpdateBadgeDiv.style.display = "block";
        } else {
            UpdateBadgeDiv.style.display = "none";
        }
    } else {
        NoInternetDiv.style.display = "block";
        GitHubIssueDiv.style.display = "none";
        GitHubDiv.style.display = "none";
        UpdateBadgeDiv.style.display = "none";
    }
}

// Exécution de la gestion des badges
ManageBadges();
