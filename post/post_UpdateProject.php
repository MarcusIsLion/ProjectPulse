<?php

//j'affiche toutes les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupérer les valeurs du formulaire POST
$originalProjectName = $_POST["originalProjectName"];
$projectName = $_POST["projectName"];
$projectType = $_POST["projectType"];
$projectState = $_POST["projectState"];
$projectVisual = $_POST["projectVisual"];
$projectLanguage = $_POST["projectLanguage"];

// Définir les chemins
$originalDirectory = '../' . $originalProjectName;
$newDirectory = '../Website/' . $projectName;

try {
    // Si le nom du projet a changé, renommer le dossier
    if ($originalProjectName !== $projectName && is_dir($originalDirectory)) {
        rename($originalDirectory, $newDirectory);
    }

    // Mettre à jour ou créer le fichier JSON
    $projectDirectory = is_dir($newDirectory) ? $newDirectory : $originalDirectory;
    $jsonFilePath = $projectDirectory . '/type.json';

    $data = [
        "type" => $projectType,
        "state" => $projectState,
        "visual" => $projectVisual,
        "language" => $projectLanguage
    ];

    $jsonContent = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($jsonFilePath, $jsonContent);
    // Rediriger l'utilisateur vers index.php
    header('Location: ../index.php');
    exit;
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
    exit;
}
