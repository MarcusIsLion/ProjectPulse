<?php
require_once("../function/GetJsonFromFile.php");
require_once("../includes/echoCssFiles.php");
$localData = getJsonFromFile("../data/version.json");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echoCssFiles("../css/");
    ?>
    <link rel="stylesheet" href="../css/creationProject.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Creation of a structure project</title>
</head>

<body class="<?= $localData["theme"] ?>">

    <div id="VersionBadgeDiv"><a href="https://github.com/MarcusIsLion/ProjectPulse" target="_blank" class="UpdateBadge"><img src="https://img.shields.io/badge/ProjectPulse%20has%20a%20new%20update%20available-20B2AA?style=for-the-badgebadge" alt="An update is availible" /></a></div>
    <div id="NoInternetDiv"><img src="../img/NoInternet.png" alt="No internet image" class="NoInternet" /></div>
    <h1>Creation of a structure project</h1>
    <form id="project-form">
        <input type="text" id="StructureName" placeholder="Name of the structure">
        <input type="text" id="StructureType" placeholder="Languages in this structure">
        <button id="submitbutton" type="button" class="button GeneralButton">Create Structure</button>
        <button id="cancelbutton" type="button" class="button GeneralButton">Cancel</button>
    </form>
    <h3 id="RegisterError" class="RegisterError">Please, register a name and/or the languages of the structure before creating your structure.</h3>
    <div class="container" id="ConstructionZone">
        <div class="draggable-items">
            <h3><i class="fa-solid fa-angles-down"></i> Draggable items <i class="fa-solid fa-angles-down"></i></h3>
            <div class="draggable" draggable="true" ondragstart="drag(event)" id="folder">Dossier</div>
            <div class="draggable" draggable="true" ondragstart="drag(event)" id="file">Fichier</div>
        </div>
        <div class="StructureAreaBuilder">
            <h3><i class="fa-solid fa-angles-down"></i> Construction area <i class="fa-solid fa-angles-down"></i></h3>
            <div class="folder-container" id="drop-zone" ondrop="drop(event)" ondragover="allowDrop(event)">
                <div id="file-list"></div>
            </div>
        </div>
    </div>

    <footer>
        <div class="BottomButton">
            <div class="StartBottomButton">
                <?php
                // Lire le fichier CSS
                $cssFile = '../css/theme.css';

                // Fonction pour extraire les classes CSS qui contiennent 'theme'
                function extractThemes($file)
                {
                    $themes = [];
                    if (file_exists($file)) {
                        $cssContent = file_get_contents($file);

                        // Rechercher les classes de type .themeClass (adaptation à votre fichier)
                        preg_match_all('/\.([a-zA-Z0-9-_]+)\s*\{/', $cssContent, $matches);

                        $themes[] = 'Light';
                        // Filtrer uniquement les classes contenant 'theme' dans le nom
                        foreach ($matches[1] as $className) {
                            $themes[] = $className;
                        }
                    }
                    return $themes;
                }

                // Extraire les thèmes depuis le fichier CSS
                $themes = extractThemes($cssFile);

                // Valeur sélectionnée dans $localData
                $selectedTheme = $localData['theme'] ?? '';

                ?>

                <div id="FooterForm">
                    <form id="themeForm" method="post">
                        <select name="theme" id="theme" class="SelectTheme">
                            <?php
                            // Générer les options dynamiquement
                            foreach ($themes as $theme) {
                                $isSelected = ($theme == $selectedTheme) ? 'selected' : '';
                                echo "<option value=\"$theme\" $isSelected>" . ucfirst(str_replace('-', ' ', $theme)) . "</option>";
                            }
                            ?>
                        </select>
                    </form>
                </div>

                <div id="GitHubIssueDiv"><a href="https://github.com/MarcusIsLion/ProjectPulse/issues/new" target="_blank" class="IssueBadge"><img src="https://img.shields.io/badge/issue-error-red?logo=x-circle" alt="badge to acces to the issue form" /></a>
                </div>
            </div>
            <div class="CenterBottomButton">
            </div>
            <div class="EndBottomButton">
                <div id="GitHubDiv"><a href="https://github.com/MarcusIsLion" target="_blank" class="GithubBadge"><img src="https://img.shields.io/badge/GitHub-MarcusIsLion-blue?logo=github" alt="badge reprensenting the github account of the developper" /></a></div>
            </div>
        </div>
    </footer>

    <script src="../js/CreateStrucutre.js"></script>
    <script src="../js/CheckInternetConnection.js"></script>
    <script src="../js/ThemeGestion.js"></script>
</body>

</html>