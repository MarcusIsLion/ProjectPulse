<?php
include_once("../function/GetJsonFromUrl.php");
include_once("../function/GetJsonFromFile.php");
$localData = getJsonFromFile("../data/version.json");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download more structure</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/theme.css">
</head>

<body class="<?= $localData["theme"] ?>">
    <div class="container">
        <h1>Check all structure you wanna get :</h1>
        <div class="FormContainer">
            <form action="../post/post_DownloadStructure.php" method="post">
                <div class="FormCheckBoxGrid">
                    <?php
                    // Charger les fichiers JSON en ligne et local
                    $OnlineprojectLanguage = json_decode(file_get_contents("https://raw.githubusercontent.com/MarcusIsLion/ProjectPulse/main/data/projectstructure.json"), true);
                    $LocalprojectLanguage = json_decode(file_get_contents("../data/enum/ProjectLanguage.json"), true);
                    // Boucle sur chaque élément du fichier en ligne
                    foreach ($OnlineprojectLanguage as $onlineKey => $onlineValue) {
                        $checked = false; // Indicateur pour savoir si l'élément doit être précoché

                        // Boucle sur chaque élément du fichier local
                        foreach ($LocalprojectLanguage as $localKey => $localValue) {
                            // Vérifier si l'ID correspond entre les fichiers en ligne et local
                            if ($onlineValue['id'] == $localValue['id']) {
                                $checked = true; // Correspondance trouvée, l'élément sera précoché
                                break; // On peut sortir de la boucle interne, car une correspondance a été trouvée
                            }
                        }
                        // Afficher la case avec ou sans précochage
                        if ($checked) {
                            echo '<input type="checkbox" name="projectStructure[]" value="' . $onlineValue['id'] . '" checked> ' . $onlineValue['name'] . '<br>';
                        } else {
                            echo '<input type="checkbox" name="projectStructure[]" value="' . $onlineValue['id'] . '"> ' . $onlineValue['name'] . '<br>';
                        }
                    }
                    ?>
                </div><br>
                <input type="submit" value="Download all structures selected" class="button ValidationCreation" />
            </form>
        </div>
        <a href="CreateNewProject.php">Cancel</a>
    </div>
</body>

</html>