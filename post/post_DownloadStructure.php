<?php
if (isset($_POST)) {
    // pour chaque post coché, on va le télécharger et l'ajouter au fichier local si il n'existe d'éjà pas ou suppression si il existe déjà mais qu'il est décoché
    include_once("../function/GetJsonFromUrl.php");
    include_once("../function/GetJsonFromFile.php");
    $OnlineprojectLanguage = getJsonFromUrl("https://raw.githubusercontent.com/MarcusIsLion/ProjectPulse/ProjectStructure/structureToDownload.json");
    $LocalprojectLanguage = getJsonFromFile("../data/enum/ProjectLanguage.json");
    foreach ($OnlineprojectLanguage as $onlineKey => $onlineValue) {
        $checked = false;
        foreach ($LocalprojectLanguage as $localKey => $localValue) {
            if ($onlineValue['id'] == $localValue['id']) {
                $checked = true;
                break;
            }
        }
        if (isset($_POST['projectStructure'])) {
            if (in_array($onlineValue['id'], $_POST['projectStructure'])) {
                if (!$checked) {
                    array_push($LocalprojectLanguage, $onlineValue);
                }
            } else {
                if ($checked) {
                    foreach ($LocalprojectLanguage as $localKey => $localValue) {
                        if ($onlineValue['id'] == $localValue['id']) {
                            unset($LocalprojectLanguage[$localKey]);
                            break;
                        }
                    }
                }
            }
        }
    }
    // On écrit le fichier local
    $json = json_encode($LocalprojectLanguage, JSON_PRETTY_PRINT);
    file_put_contents("../data/enum/ProjectLanguage.json", $json);
    header("Location: ../page/CreateNewProject.php");
} else {
    header("Location: ../page/DownloadStructure.php");
}
