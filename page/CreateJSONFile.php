<?php
require_once("../function/GetJsonFromFile.php");
require_once("../includes/echoCssFiles.php");
$localData = getJsonFromFile("../data/version.json");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create a new json file</title>
    <?php
    echoCssFiles("../public/css/");
    ?>
</head>

<body class="<?= $localData["theme"] ?>">
    <div class="container">
        <h1>Please, register informations to create your new json file :</h1>
        <div class="Form-Grid-Container">
            <div class="Form-Grid">
                <form action="../post/post_createJsonFile.php" method="post">
                    <input type="hidden" name="projectDirectory" value="../Projects/<?= $_GET['ProjectName'] ?>" />
                    <label for="projectType">Type of the project :</label>
                    <input type="text" id="projectType" name=" projectType" placeholder="Type of the project" required /><br />
                    <label for="projectState">State of the project :</label>
                    <select name="projectState" id="projectState">
                        <option value="Standby">Stand by</option>
                        <option value="Stoped">Stoped</option>
                        <option value="Finished">Finished</option>
                        <option value="Development">In development</option>
                    </select><br />
                    <label for="projectVisual">Visual of the project :</label>
                    <select name="projectVisual" id="projectVisual">
                        <option value="hidden">Hidden</option>
                        <option value="visible">Visible</option>
                    </select><br />
                    <label for="projectLanguage">Language in the project :</label>
                    <input type="text" id="projectLanguage" name="projectLanguage" placeholder="Language of the project" required /><br />
                    <input type="submit" value="Create the project" class="button ValidationCreation" />
                </form>
            </div>
        </div>
        <a href="../index.php">Cancel</a>
    </div>
</body>

</html>