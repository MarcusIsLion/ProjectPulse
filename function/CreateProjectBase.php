<?php

require_once("getJsonFromFile.php");
require_once("CreateJsonFile.php");

function CreateFile($projectDirectory, $folder, $file)
{
    // Créer le fichier dans le bon dossier
    file_put_contents($projectDirectory . "/" . $folder["name"] . "/" . $file, "");
}

function CreateFolder($projectDirectory, $folder)
{
    // Vérifier si $folder est bien un tableau
    if (!is_array($folder)) {
        throw new TypeError("Expected an array, but got a string for folder.");
    }

    // Créer le dossier sauf si c'est "base"
    if ($folder["name"] !== "base") {
        mkdir($projectDirectory . "/" . $folder["name"]);
    }

    // Créer les sous-dossiers
    if (isset($folder["folders"]) && is_array($folder["folders"])) {
        foreach ($folder["folders"] as $subFolder) {
            CreateFolder($projectDirectory . "/" . $folder["name"], $subFolder);
        }
    }

    // Créer les fichiers
    if (isset($folder["files"]) && is_array($folder["files"])) {
        foreach ($folder["files"] as $file) {
            // Si le dossier est "base", créer les fichiers directement dans le répertoire projet
            if ($folder["name"] === "base") {
                file_put_contents($projectDirectory . "/" . $file, "");
            } else {
                CreateFile($projectDirectory, $folder, $file);
            }
        }
    }
}

function CreateProjectBase($ProjectStructureId, $projectType, $projectDirectory, $projectVisual)
{
    // Récupérer la liste des langues du fichier enum
    $JsonFile = getJsonFromFile("../data/enum/ProjectLanguage.json");


    // Récupérer la langue à partir de l'ID
    foreach ($JsonFile as $key => $value) {
        if ($value["id"] === $ProjectStructureId) {
            $ProjectStructure = $value;
        }
    }
    // Créer le répertoire du projet
    mkdir($projectDirectory);

    // Créer les fichiers et dossiers du projet
    foreach ($ProjectStructure["FolderNedded"] as $folderKey => $folder) {
        // Si le dossier est "base", on ne le crée pas mais on crée son contenu
        if ($folderKey === "base") {
            // Créer les sous-dossiers et fichiers à l'intérieur de "base" sans créer le dossier "base"
            foreach ($folder["folders"] as $subFolder) {
                CreateFolder($projectDirectory, $subFolder);
            }
            // Créer les fichiers de "base" directement dans le répertoire projet
            foreach ($folder["files"] as $file) {
                file_put_contents($projectDirectory . "/" . $file, "");
            }
        } else {
            // Créer les autres dossiers normalement
            CreateFolder($projectDirectory, $folder);
        }
    }
    createJsonFile($projectDirectory, $projectType, "Development", $projectVisual, $ProjectStructure["language"]);
}
