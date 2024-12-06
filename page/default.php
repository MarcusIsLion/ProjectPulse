<?php
require_once("../includes/echoCssFiles.php");
require_once("../function/GetJsonFromFile.php");
require_once("../includes/ReadMeRender.php");
require_once("../includes/GenerateTreeForDefault.php");
$localData = getJsonFromFile("../data/version.json");
$baseProjectPath = __DIR__ . $_GET['FullPath'];
$baseProjectPath = str_replace("page ../", "", $baseProjectPath);
$baseProjectPath = str_replace("/", "\\", $baseProjectPath);
$readmeFile = $baseProjectPath . "/README.md";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ProjectPulse : Default page</title>
    <?php
    echoCssFiles("../public/css/", ["../public/css/creationProject.css"]);
    ?>
    <link rel="icon" href="../public/img/Logo.png" />
    <link rel="apple-touch-icon" href="../public/img/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="<?= $localData["theme"] ?>">
    <div class="CenterSectionTopGrid">
        <img src="../public/img/Logo.png" width="40px" height="40px" class="LogoTitle" />
        <h1 id="waveText"> <span>P</span><span>r</span><span>o</span><span>j</span><span>e</span><span>c</span><span>t</span><span>P</span><span>u</span><span>l</span><span>s</span><span>e</span></h1>
    </div>
    <a class="button" href="../index.php">Retour</a>
    <h2>This is the default page, please make sure to create a "index.php" or "index.html" file at "<?= $baseProjectPath ?>" to see your own personal web page.</h2>


    <div class="RMBAndFTB">
        <div class='readme-box'>
            <?php
            $readmeRenderer = new ReadmeRenderer($readmeFile);
            echo $readmeRenderer->render();
            ?>
        </div>

        <div id="file-tree">
            <h3>Project folder vision</h3>
            <?php echo generateFileTree($baseProjectPath); ?>
        </div>
    </div>


    <footer>
        <div class="BottomButton">
            <div class="StartBottomButton">
                <?php
                // Lire le fichier CSS
                $cssFile = '../public/css/theme.css';

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
                <a href="page/CreateNewProject.php" class="button GeneralButton">Create a new project <i class="fa-solid fa-plus"></i></a>

                <a class="button SecretManager GeneralButton smooth-link" href="#HiddenCardGrid">See hidden projects <i class="fa-solid fa-eye"></i></a>
            </div>
            <div class="EndBottomButton">
                <div id="GitHubDiv"><a href="https://github.com/MarcusIsLion" target="_blank" class="GithubBadge"><img src="https://img.shields.io/badge/GitHub-MarcusIsLion-blue?logo=github" alt="badge reprensenting the github account of the developper" /></a></div>
            </div>
        </div>
    </footer>

    <script src="../public/js/WavingTextJS.js"></script>
    <script src="../public/js/CheckInternetConnection.js"></script>
    <script src="../public/js/ThemeGestion.js"></script>
    <script src="../public/js/WrapAndUnwrapFolder.js"></script>
</body>

</html>