<?php
include_once("../function/GetJsonFromUrl.php");
include_once("../function/GetJsonFromFile.php");
require_once("../includes/echoCssFiles.php");
$localData = getJsonFromFile("../data/version.json");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download more structure</title>
    <?php
    echoCssFiles("../public/css/");
    ?>
</head>

<body class="<?= $localData["theme"] ?>">
    <div class="container">
        <h1>Check all online structures you wanna get :</h1>
        <div class="FormContainer">
            <form action="../post/post_DownloadStructure.php" method="post">
                <div class="FormCheckBoxGrid">
                    <?php
                    // Charger les fichiers JSON en ligne et local
                    $OnlineprojectLanguage = json_decode(file_get_contents("https://raw.githubusercontent.com/MarcusIsLion/ProjectPulse/main/data/enum/ProjectLanguage.json"), true);
                    $LocalprojectLanguage = json_decode(file_get_contents("../data/enum/ProjectLanguage.json"), true);
                    // Boucle sur chaque élément du fichier en ligne
                    foreach ($OnlineprojectLanguage as $onlineKey => $onlineValue) {
                        $checked = false; // Indicateur pour savoir si l'élément doit être précoché

                        // Boucle sur chaque élément du fichier local
                        foreach ($LocalprojectLanguage as $localKey => $localValue) {
                            // Vérifier si l'ID correspond entre les fichiers en ligne et local
                            if (isset($localValue['id']) && isset($onlineValue['id']) && $onlineValue['id'] == $localValue['id']) {
                                $checked = true; // Correspondance trouvée, l'élément sera précoché
                                break; // On peut sortir de la boucle interne, car une correspondance a été trouvée
                            } else {
                                $checked = false; // Pas de correspondance, l'élément ne sera pas précoché
                            }
                        }

                        // si l'élément à comme nom "Undifined" alors on foce la coche
                        if ($onlineValue['name'] == "Undifined") {
                            $checked = true;
                        }

                        // Afficher la case avec ou sans précochage
                        if ($checked) {
                            // si l'élément à comme nom "Undifined" alors on ne peut pas le décocher
                            if ($onlineValue['name'] == "Undifined") {
                                echo '<input type="checkbox" name="projectStructure[]" value="' . $onlineValue['id'] . '" checked disabled> ' . $onlineValue['name'] . ' (' . $onlineValue['language'] . ')<br>';
                            } else {
                                echo '<input type="checkbox" name="projectStructure[]" value="' . $onlineValue['id'] . '" checked> ' . $onlineValue['name'] . ' (' . $onlineValue['language'] . ')<br>';
                            }
                        } else {
                            echo '<input type="checkbox" name="projectStructure[]" value="' . $onlineValue['id'] . '"> ' . $onlineValue['name'] . ' (' . $onlineValue['language'] . ')<br>';
                        }
                    }
                    ?>
                </div><br>
                <input type="submit" value="Download all selected structures" class="button ValidationCreation" />
            </form>
        </div>
        <div class="Separator"></div>
        <h1>Unchecked all local structures you wanna delete :</h1>
        <div class="FormContainer">
            <form action="#" method="post">
                <div class="FormCheckBoxGrid">
                    <?php
                    // Charger les fichiers JSON en ligne et local
                    $OnlineprojectLanguage = json_decode(file_get_contents("https://raw.githubusercontent.com/MarcusIsLion/ProjectPulse/main/data/enum/ProjectLanguage.json"), true);
                    $LocalprojectLanguage = json_decode(file_get_contents("../data/enum/ProjectLanguage.json"), true);
                    // Boucle sur chaque élément du fichier en ligne
                    foreach ($LocalprojectLanguage as $localKey => $localValue) {
                        $printProjectStructure = false; // Indicateur pour savoir si l'élément doit être affiché
                        // si l'id du projet local est identique à celui en ligne alors on ne l'affiche pas
                        foreach ($OnlineprojectLanguage as $onlineKey => $onlineValue) {
                            if ($onlineValue['id'] == $localValue['id']) {
                                $printProjectStructure = false; // Correspondance trouvée, l'élément ne sera pas affiché
                                break; // On peut sortir de la boucle interne, car une correspondance a été trouvée
                            } else {
                                $printProjectStructure = true; // Pas de correspondance, l'élément sera affiché
                            }
                        }

                        $checked = true; // Indicateur pour savoir si l'élément doit être précoché
                        if ($printProjectStructure) {
                            echo '<input type="checkbox" name="projectStructure[]" value="' . $localValue['id'] . '" checked disabled> ' . $localValue['name'] . ' (' . $localValue['language'] . ')<br>';
                        }
                    }
                    ?>
                </div><br>
                <input type="submit" value="Delete all unselected structures" class="button ValidationCreation" />
            </form>
        </div>
        <div class="Separator"></div>
        <button id="CreateNewStructure" type="button" class="button ValidationCreation">Create a new structure</button>
        <button id="cancelButton" type="button" class="button ValidationCreation">Cancel</button>
    </div>
    <script src="../public/js/DownloadStrucutrePageGestion.js"></script>
</body>

</html>