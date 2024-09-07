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
        <?php if (!CheckVersions()) { ?>
            <a href="https://github.com/MarcusIsLion/ProjectPulse" target="_blank" class="UpdateBadge"><img src="https://img.shields.io/badge/ProjectPulse%20has%20a%20new%20update%20available-20B2AA?style=for-the-badgebadge" alt="An update is availible" /></a>
            <script src="js/UpdateBadgeGestion.js"></script>
        <?php
        }
        ?>
        <div class="Head">
            <img src="img/Logo.png" width="40px" height="40px" class="LogoTitle" />
            <h1 id="waveText"> <span>P</span><span>r</span><span>o</span><span>j</span><span>e</span><span>c</span><span>t</span><span>P</span><span>u</span><span>l</span><span>s</span><span>e</span></h1>
        </div>
        <h2>
            You will find here, all the projects that you have created and that are in development. You can also create a new project or modify the characteristics of an existing project.
        </h2>

        <div class="card-grid">
            <?php
            $dossiers = scandir("Projects/");

            foreach ($dossiers as $dossier) {
                $LanguageIdPopover++;
                $chemin_complet = "Projects/" . $dossier;
                if (is_dir($chemin_complet) && $dossier != "." && $dossier != ".." && $dossier != "post") {
                    $visual = json_decode(file_get_contents("Projects/" . $dossier . "/type.json"))->visual;
                    if ($visual != "hidden") {
                        $state = json_decode(file_get_contents($chemin_complet . "/type.json"))->state;

                        $logo = findLogo($chemin_complet);
            ?>
                        <div class="card">
                            <?php if ($logo) { ?>
                                <div class="logo-background" style="background-image: url('<?= htmlspecialchars($logo, ENT_QUOTES) ?>');"></div>
                            <?php } ?>
                            <div class="CardContent">
                                <h2><?= htmlspecialchars($dossier, ENT_QUOTES) ?></h2>
                                <ul>
                                    <li>
                                        <p>Size : <?= round((filesize($chemin_complet) / 1024), 2) ?> Ko</p>
                                    </li>
                                    <li>
                                        <p>Created at : <?= date("d/m/Y", filectime($chemin_complet)) ?></p>
                                    </li>
                                    <li>
                                        <p>Updated at : <?= date("d/m/Y", filemtime($chemin_complet)) ?></p>
                                    </li>
                                    <li>
                                        <p><?= count(scandir($chemin_complet)) ?> files / <?= count(glob($chemin_complet . '/*', GLOB_ONLYDIR)) ?> folders</p>
                                    </li>
                                    <li>
                                        <p>Type : <?= json_decode(file_get_contents($chemin_complet . "/type.json"))->type ?>
                                        <div class="icon-container">
                                            <!-- Icône Font Awesome -->
                                            <button onclick="afficherPopover(<?= 'LanguageIdPopover' . $LanguageIdPopover ?>)" class="NotButton"><i class="fas fa-info-circle popover-icon"></i></button>
                                            <!-- Popover -->
                                            <div class="popover hidden" id="<?= 'LanguageIdPopover' . $LanguageIdPopover ?>">
                                                <?= json_decode(file_get_contents($chemin_complet . "/type.json"))->language ?>
                                            </div>
                                        </div>
                                        </p>
                                    </li>
                                    <li class=" <?= htmlspecialchars($state, ENT_QUOTES) ?>">
                                        <p>State : <?= json_decode(file_get_contents($chemin_complet . "/type.json"))->state ?></p>
                                    </li>
                                </ul>
                                <div class="CardButtonSection">
                                    <a href="<?= htmlspecialchars($chemin_complet, ENT_QUOTES) ?>" class="button">Open this project</a>
                                    <a href="page/UpdateProject.php?ProjectName=<?= htmlspecialchars($chemin_complet, ENT_QUOTES) ?>" class="button">Update theses characteristics</a>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>

        <div class="BottomButton">
            <div class="StartBottomButton">
                <form action="post/post_ChangeTheme.php" method="post">
                    <select name="theme" id="theme" class="SelectTheme" onchange="this.form.submit()">
                        <option value="light" <?= $localData["theme"] == "light" ? "selected" : "" ?>>Light</option>
                        <option value="dark" <?= $localData["theme"] == "dark" ? "selected" : "" ?>>Dark</option>
                    </select>
                </form>
                <a href="https://github.com/MarcusIsLion/ProjectPulse/issues/new" target="_blank" class="IssueBadge"><img src="https://img.shields.io/badge/issue-error-red?logo=x-circle" alt="badge to acces to the issue form" /></a>
            </div>
            <div class="CenterBottomButton">
                <a href="page/CreateNewProject.php" class="button GeneralButton">Create a new project</a>

                <button class="button SecretManager GeneralButton smooth-link">See hidden projects <i class="fa-solid fa-eye"></i></button>
            </div>
            <div class="EndBottomButton">
                <a href="https://github.com/MarcusIsLion" target="_blank" class="GithubBadge"><img src="https://img.shields.io/badge/GitHub-MarcusIsLion-blue?logo=github" alt="badge reprensenting the github account of the developper" /></a>
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
                ?>
                            <div class="card">
                                <?php if ($logo) { ?>
                                    <div class="logo-background" style="background-image: url('<?= htmlspecialchars($logo, ENT_QUOTES) ?>');"></div>
                                <?php } ?>
                                <div class="CardContent">
                                    <h2><?= htmlspecialchars($dossier, ENT_QUOTES) ?></h2>
                                    <ul>
                                        <li>
                                            <p>Size : <?= round((filesize($chemin_complet) / 1024), 2) ?> Ko</p>
                                        </li>
                                        <li>
                                            <p>Created at : <?= date("d/m/Y", filectime($chemin_complet)) ?></p>
                                        </li>
                                        <li>
                                            <p>Updated at : <?= date("d/m/Y", filemtime($chemin_complet)) ?></p>
                                        </li>
                                        <li>
                                            <p><?= count(scandir($chemin_complet)) ?> files / <?= count(glob($chemin_complet . '/*', GLOB_ONLYDIR)) ?> folders</p>
                                        </li>
                                        <li>
                                            <p>Type : <?= json_decode(file_get_contents($chemin_complet . "/type.json"))->type ?></p>
                                        </li>
                                        <li class=" <?= htmlspecialchars($state, ENT_QUOTES) ?>">
                                            <p>State : <?= json_decode(file_get_contents($chemin_complet . "/type.json"))->state ?></p>
                                        </li>
                                    </ul>
                                    <div class="CardButtonSection">
                                        <a href="<?= htmlspecialchars($chemin_complet, ENT_QUOTES) ?>" class="button">Open this project</a>
                                        <a href="page/UpdateProject.php?ProjectName=<?= htmlspecialchars($chemin_complet, ENT_QUOTES) ?>" class="button">Update theses characteristics</a>
                                    </div>
                                </div>
                            </div>
                <?php
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