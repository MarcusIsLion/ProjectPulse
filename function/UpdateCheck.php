<?php
// URL du fichier JSON sur GitHub
$githubJsonUrl = 'https://raw.githubusercontent.com/MarcusIsLion/ProjectPulse/main/data/version.json';

// Chemin du fichier local version.json
$localJsonPath = __DIR__ . '/data/version.json';

// Fonction pour récupérer le contenu JSON à partir d'une URL
function getJsonFromUrl($url)
{
    $json = file_get_contents($url);
    if ($json === false) {
        throw new Exception("Impossible de récupérer le fichier JSON depuis l'URL : $url");
    }
    return json_decode($json, true);
}

// Fonction pour récupérer le contenu JSON à partir d'un fichier local
function getJsonFromFile($filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception("Le fichier local n'existe pas : $filePath");
    }
    $json = file_get_contents($filePath);
    return json_decode($json, true);
}

try {
    // Récupération de la version depuis l'URL GitHub
    $githubData = getJsonFromUrl($githubJsonUrl);
    $githubVersion = $githubData['version'];

    // Récupération de la version depuis le fichier local
    $localData = getJsonFromFile($localJsonPath);
    $localVersion = $localData['version'];

    // Comparaison des versions
    if ($githubVersion === $localVersion) {
        echo "Les versions correspondent : $localVersion";
    } else {
        echo "Les versions ne correspondent pas.\nVersion GitHub : $githubVersion\nVersion locale : $localVersion";
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
