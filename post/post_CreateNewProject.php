<?php
// Récupérer les valeurs du formulaire POST
$projectName = $_POST["projectName"];
$projectType = $_POST["projectType"];
$projectLanguage = $_POST["projectLanguage"];

// Définir le chemin du nouveau dossier
$projectDirectory = '../Website/' . $projectName;

// Vérifier si le dossier n'existe pas déjà
if (!is_dir($projectDirectory)) {
    // Créer le dossier avec les permissions appropriées (0777 pour lecture, écriture, exécution)
    mkdir($projectDirectory, 0777, true);

    // Contenu du fichier JSON
    $data = [
        "type" => $projectType,
        "state" => "Development",
        "visual" => "visible",
        "language" => $projectLanguage
    ];

    // Encodage du contenu en JSON
    $jsonContent = json_encode($data, JSON_PRETTY_PRINT);

    // Chemin complet pour le fichier type.json
    $jsonFilePath = $projectDirectory . '/type.json';

    // Créer et écrire dans le fichier type.json
    file_put_contents($jsonFilePath, $jsonContent);
}

// Rediriger l'utilisateur vers index.php
header('Location: ../Website/' . $projectName);
exit;
