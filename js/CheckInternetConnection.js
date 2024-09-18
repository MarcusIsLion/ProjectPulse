async function isInternetAvailable() {
    try {
        const controller = new AbortController();
        const signal = controller.signal;

        // Timeout après 1 seconde si la requête est trop longue
        const timeout = setTimeout(() => controller.abort(), 1000);

        // Correction de l'URL : utilisation de github.com au lieu de www.github.com
        const response = await fetch("https://github.com", { mode: "no-cors" });

        clearTimeout(timeout);

        // Si la requête passe et qu'on a une réponse, la connexion est disponible
        return response.ok;
    } catch (error) {
        // En cas d'erreur ou d'expiration du délai, on considère qu'il n'y a pas de connexion
        return false;
    }
}

/**
 * Fonction pour vérifier les versions entre le fichier distant et le fichier local.
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

        // Récupérer la version du fichier JSON local depuis localStorage
        const localData = getJsonFromLocalStorage("version.json");
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
 * Fonction pour récupérer un fichier JSON à partir d'une URL.
 * @param {string} url L'URL du fichier JSON.
 * @return {Promise<Object>} Retourne les données JSON sous forme d'objet.
 */
async function getJsonFromUrl(url) {
    const response = await fetch(url);
    if (!response.ok) {
        throw new Error(
            `Erreur lors de la récupération des données : ${response.statusText}`
        );
    }
    return await response.json();
}

/**
 * Fonction pour récupérer un fichier JSON depuis localStorage.
 * @param {string} key La clé sous laquelle le JSON est stocké dans localStorage.
 * @return {Object|null} Retourne les données JSON stockées ou null si elles n'existent pas.
 */
function getJsonFromLocalStorage(key) {
    const data = localStorage.getItem(key);
    return data ? JSON.parse(data) : null;
}

// Gestion des éléments DOM
const NoInternetDiv = document.getElementById("NoInternetDiv");
const GitHubIssueDiv = document.getElementById("GitHubIssueDiv");
const GitHubDiv = document.getElementById("GitHubDiv");
const UpdateBadgeDiv = document.getElementById("VersionBadgeDiv");

async function ManageBadges() {
    const isInternet = await isInternetAvailable();

    if (isInternet) {
        NoInternetDiv.style.display = "block";
        GitHubIssueDiv.style.display = "none";
        GitHubDiv.style.display = "none";
        UpdateBadgeDiv.style.display = "none";
    } else {
        NoInternetDiv.style.display = "none";
        GitHubIssueDiv.style.display = "block";
        GitHubDiv.style.display = "block";

        const isUpdated = await CheckVersions();
        if (!isUpdated) {
            UpdateBadgeDiv.style.display = "block";
        } else {
            UpdateBadgeDiv.style.display = "none";
        }
    }
}

// Exécution de la gestion des badges
ManageBadges();
