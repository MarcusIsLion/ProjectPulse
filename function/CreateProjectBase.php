<?php

// structure of the ProjectLanguage.json file
// "1": {
//         "id": "1",
//         "name": "Static Website",
//         "value": "StaticWeb",
//         "FolderNedded": {
//             "base": {
//                 "name": "base",
//                 "folders": {
//                     "css": {
//                         "name": "css",
//                         "folders": [],
//                         "files": ["style.css"]
//                     },
//                     "js": {
//                         "name": "js",
//                         "folders": [],
//                         "files": []
//                     },
//                     "img": {
//                         "name": "img",
//                         "folders": ["icons", "others"],
//                         "files": []
//                     },
//                     "fonts": {
//                         "name": "fonts",
//                         "folders": [],
//                         "files": []
//                     }
//                 },
//                 "files": ["index.html"]
//             }
//         }
//     }

include_once("getJsonFromFile.php");

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

function CreateProjectBase($projectLanguageId, $projectName, $projectType, $projectDirectory)
{
    // Récupérer la liste des langues du fichier enum
    $JsonFile = getJsonFromFile("../data/enum/ProjectLanguage.json");

    // Récupérer la langue à partir de l'ID
    $projectLanguage = $JsonFile[$projectLanguageId];

    // Créer le répertoire du projet
    mkdir($projectDirectory);

    // Créer les fichiers et dossiers du projet
    foreach ($projectLanguage["FolderNedded"] as $folderKey => $folder) {
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

    // Créer le fichier JSON du projet
    $projectJson = array(
        "type" => $projectType,
        "state" => "Developpement",
        "visual" => "hidden",
        "language" => $projectLanguage["value"],
    );
    file_put_contents($projectDirectory . "/type.json", json_encode($projectJson));
}
