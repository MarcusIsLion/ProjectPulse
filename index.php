<?php
function findLogo($basePath)
{
    $folders = ['img', 'images', 'image'];
    $extensions = ['png', 'jpeg', 'jpg', 'gif'];

    foreach ($folders as $folder) {
        foreach ($extensions as $ext) {
            $logoPath = "$basePath/$folder/logo.$ext";
            if (file_exists($logoPath)) {
                return $logoPath;
            }
        }
    }
    return null;
}

$LanguageIdPopover = 0;


include_once("function/UpdateCheck.php");
include_once("function/InternetConnectionCheck.php");
include_once("function/GetFolderSize.php");
include_once("includes/card.php");
include_once("includes/alertbox.php");
$localData = getJsonFromFile("data/version.json");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ProjectPulse : Home</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/theme.css" />
    <link rel="icon" href="img/Logo.png" />
    <link rel="apple-touch-icon" href="img/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="<?= $localData["theme"] ?>">
    <div class="container">
        <?php
        if (isInternetAvailable()) {
            if (!CheckVersions()) { ?>
                <a href="https://github.com/MarcusIsLion/ProjectPulse" target="_blank" class="UpdateBadge"><img src="https://img.shields.io/badge/ProjectPulse%20has%20a%20new%20update%20available-20B2AA?style=for-the-badgebadge" alt="An update is availible" /></a>
                <script src="js/UpdateBadgeGestion.js"></script>
            <?php
            }
        } else {
            ?>
            <img src="img/NoInternet.png" alt="No internet image" class="NoInternet" />
        <?php
        }
        if (isset($_GET['GitFolder'])) {
            generateAlertBox("A \".git\" folder has been found and can't be delete automaticly. Please delete it manualy.", "error", "index.php");
        }
        ?>
        <div class="Head">
            <img src="img/Logo.png" width="40px" height="40px" class="LogoTitle" />
            <h1 id="waveText"> <span>P</span><span>r</span><span>o</span><span>j</span><span>e</span><span>c</span><span>t</span><span>P</span><span>u</span><span>l</span><span>s</span><span>e</span></h1>
        </div>
        <h2>
            You will find here, all the projects that you have created and that are in development. You can also create a new project or modify the characteristics of an existing project.
        </h2>

        <?php
        if (is_dir("Projects/")) {
            $dossiers = scandir("Projects/");

            // Filtrer les dossiers pour ne garder que ceux qui ne sont pas "." et ".."
            $dossiers_utiles = array_filter($dossiers, function ($dossier) {
                return $dossier != "." && $dossier != "..";
            });

            // Si après filtrage il n'y a plus de dossiers utiles, afficher "No project found"
            if (empty($dossiers_utiles)) { ?>
                <h3>No project found.</h3>
            <?php
            } else { ?>
                <div class="card-grid">
                    <?php
                    foreach ($dossiers_utiles as $dossier) {
                        $LanguageIdPopover++;
                        $chemin_complet = "Projects/" . $dossier;

                        if (is_dir($chemin_complet) && $dossier != "post") {
                            // vérification de l'existance du fichier type.json
                            if (!file_exists($chemin_complet . "/type.json")) {
                                generateAlertBox("The file \"type.json\" is missing in the folder \"" . $dossier . "\". Please create it.", "error", "page/ProjectSettings.php?Project=" . $dossier);
                                $visual = "hidden";
                                $state = "error";
                            } else {
                                $visual = json_decode(file_get_contents($chemin_complet . "/type.json"))->visual;
                                $state = json_decode(file_get_contents($chemin_complet . "/type.json"))->state;
                            }
                            if ($visual != "hidden") {
                                $logo = findLogo($chemin_complet);

                                echo generateCardHTML($logo, $dossier, $chemin_complet, $state, $LanguageIdPopover);
                            }
                        }
                    } ?>
                </div>
            <?php
            }
        } else { ?>
            <h3>No "Projects" folder.</h3>
        <?php
        }
        ?>


        <div class="BottomButton">
            <div class="StartBottomButton">
                <form action="post/post_ChangeTheme.php" method="post">
                    <select name="theme" id="theme" class="SelectTheme" onchange="this.form.submit()">
                        <option value="light" <?= $localData["theme"] == "light" ? "selected" : "" ?>>Light</option>
                        <option value="dark" <?= $localData["theme"] == "dark" ? "selected" : "" ?>>Dark</option>
                    </select>
                </form>
                <?php if (isInternetAvailable()) { ?>
                    <a href="https://github.com/MarcusIsLion/ProjectPulse/issues/new" target="_blank" class="IssueBadge"><img src="https://img.shields.io/badge/issue-error-red?logo=x-circle" alt="badge to acces to the issue form" /></a>
                <?php
                }
                ?>
            </div>
            <div class="CenterBottomButton">
                <a href="page/CreateNewProject.php" class="button GeneralButton">Create a new project</a>

                <button class="button SecretManager GeneralButton smooth-link">See hidden projects <i class="fa-solid fa-eye"></i></button>
            </div>
            <div class="EndBottomButton">
                <?php if (isInternetAvailable()) { ?>
                    <a href="https://github.com/MarcusIsLion" target="_blank" class="GithubBadge"><img src="https://img.shields.io/badge/GitHub-MarcusIsLion-blue?logo=github" alt="badge reprensenting the github account of the developper" /></a>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="secret hidden" id="secret">
            <div class="smooth-link"></div>
            <div class="Separator"></div>
            <h1>Hidden projects</h1>

            <div class="card-grid">
                <?php
                $dossiers = scandir("Projects/");
                foreach ($dossiers as $dossier) {
                    $LanguageIdPopover++;
                    $chemin_complet = "Projects/" . $dossier;
                    if (is_dir($chemin_complet) && $dossier != "." && $dossier != ".." && $dossier != "post") {
                        $visual = json_decode(file_get_contents("Projects/" . $dossier . "/type.json"))->visual;
                        if ($visual == "hidden") {
                            $state = json_decode(file_get_contents($chemin_complet . "/type.json"))->state;

                            $logo = findLogo($chemin_complet);
                            echo generateCardHTML($logo, $dossier, $chemin_complet, $state, $LanguageIdPopover);
                        }
                    }
                }
                ?>
            </div>
        </div>

    </div>
    <script src="js/HiddenElementGestion.js"></script>
    <script src="js/PopoverGestion.js"></script>
    <script src="js/WavingTextJS.js"></script>
</body>

</html>