<?php
include_once("../function/UpdateCheck.php");
$localData = getJsonFromFile("../data/version.json");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Créer un nouveau projet local</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/theme.css" />
</head>

<body class="<?= $localData["theme"] ?>">
    <div class="container">
        <h1>Please, register informations to create your new project :</h1>
        <div class="Form-Grid-Container">
            <div class="Form-Grid">
                <form action="../post/post_CreateNewProject.php" method="post">
                    <label for="projectName">Name of the project :</label>
                    <input type="text" id="projectName" name="projectName" placeholder="Name of the project" required /><br />
                    <label for="projectType">Type of project :</label>
                    <input type="text" id="projectType" name=" projectType" placeholder="Type of the project" required /><br />
                    <label for="projectLanguage">Structure of the project :</label>
                    <select name="projectLanguage" id="projectLanguage">
                        <?php
                        // Get the list of language from the enum file
                        $projectLanguage = getJsonFromFile("../data/enum/ProjectLanguage.json");
                        foreach ($projectLanguage as $language) { ?>
                            <option value='<?= $language["id"] ?>'><?= $language["name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <a href="DownloadStructure.php">Manage all structures</a><br>
                    <label for="visual">Display the project on the dashboard or place it in the secret part ? (visable by a button)</label>
                    <select name="visual" id="visual">
                        <option value="hidden">Hidden</option>
                        <option value="visible">Visible</option>
                    </select><br />
                    <input type="submit" value="Create the project" class="button ValidationCreation" />
                </form>
            </div>
        </div>
        <a href="../index.php">Cancel</a>
    </div>
</body>

</html>