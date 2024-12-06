<?php

// j'affiche toutes les erreurs php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$FullprojectName = $_GET['ProjectName'];
// je sépare le text Website/ du nom du projet
$projectName = explode("/", $FullprojectName)[1];
include_once("../function/GetJsonFromFile.php");
require_once("../includes/echoCssFiles.php");
$localData = getJsonFromFile("../data/version.json");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modifier le projet local</title>
    <?php
    echoCssFiles("../public/css/");
    ?>
</head>

<body class="<?= $localData["theme"] ?>">
    <div class="container">
        <h1>Modifier les informations de votre projet :</h1>
        <div>
            <form action="../post/post_UpdateProject.php" method="post">
                <input type="hidden" name="originalProjectName" value="<?= htmlspecialchars($FullprojectName) ?>" />
                <input type="hidden" name="projectLanguage" value="<?= json_decode(file_get_contents($FullprojectName . "/type.json"))->language ?>" />
                <input type="text" name="projectName" placeholder="Nom du projet" value="<?= htmlspecialchars($projectName) ?>" required />
                <input type="text" name="projectType" placeholder="Type de projet" value="<?= json_decode(file_get_contents($FullprojectName . "/type.json"))->type ?>" required />
                <!-- l'état du projet doit pouvoir être modifié -->
                <?php
                $jsonData = file_get_contents($FullprojectName . "/type.json");
                $projectData = json_decode($jsonData, true);
                $currentProjectState = isset($projectData['state']) ? $projectData['state'] : 'Development';
                $options = [
                    'Development' => 'Développement',
                    'Standby' => 'Pause',
                    'Stoped' => 'Arrété',
                    'Finished' => 'Terminé'
                ];
                ?>
                <select name="projectState" id="projectState">';
                    <option value="<?= $currentProjectState ?>"><?= $options[$currentProjectState] ?></option>
                    <?php
                    foreach ($options as $value => $label) {
                        if ($value !== $currentProjectState) {
                            echo '<option value="' . $value . '">' . $label . '</option>';
                        }
                    }
                    ?>
                </select>
                <!-- ajout d'un sélecteur pour définir la visibilité du projet entre "hidden" et "visible" -->
                <?php
                $jsonData = file_get_contents($FullprojectName . "/type.json");
                $projectData = json_decode($jsonData, true);
                $currentProjectVisual = isset($projectData['visual']) ? $projectData['visual'] : 'hidden';
                $options = [
                    'hidden' => 'Invisible',
                    'visible' => 'Visible'
                ];
                ?>
                <select name="projectVisual" id="projectVisual">';
                    <option value="<?= $currentProjectVisual ?>"><?= $options[$currentProjectVisual] ?></option>
                    <?php
                    foreach ($options as $value => $label) {
                        if ($value !== $currentProjectVisual) {
                            echo '<option value="' . $value . '">' . $label . '</option>';
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="Mettre à jour le projet" class="button ValidationCreation" />
            </form>
        </div>
        <a href="../index.php">Annuler</a>
        <a href="../post/post_DeleteProject.php?ProjectName=<?= htmlspecialchars($FullprojectName) ?>" class="DeleteButton">Supprimer le projet</a>
    </div>
</body>

</html>