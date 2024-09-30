<?php
require_once("includes/alertbox.php");
require_once("function/GetJsonFromFile.php");
require_once("includes/echoCssFiles.php");
$localData = getJsonFromFile("data/version.json");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ProjectPulse : Home</title>
    <?php
    echoCssFiles("css/");
    ?>
    <link rel="icon" href="img/Logo.png" />
    <link rel="apple-touch-icon" href="img/Logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="<?= $localData["theme"] ?>">
    <div id="popover_navbar">
        <button id="NavbarHelperCloser"><i class="fa-regular fa-circle-xmark popover-icon"></i></button>
        <p class="NavbarHelptitle">
            To research a project, you can use 4 elements :<br><br>

            The name of the project;<br>
            The state of the project;<br>
            The type of the project;<br>
            The language of the project.<br><br>

            You can also presise the research by using the following syntax :<br><br>

            "name:" to research only by project name<br>
            "state:" to research only by project state<br>
            "type:" to research only by project type<br>
            "language:" to research only by project language
        </p>
    </div>
    <div id="Hidder" class="hidden"></div>
    <div class="container">
        <div id="VersionBadgeDiv"><a href="https://github.com/MarcusIsLion/ProjectPulse" target="_blank" class="UpdateBadge"><img src="https://img.shields.io/badge/ProjectPulse%20has%20a%20new%20update%20available-20B2AA?style=for-the-badgebadge" alt="An update is availible" /></a></div>
        <div id="NoInternetDiv"><img src="img/NoInternet.png" alt="No internet image" class="NoInternet" /></div>
        <?php
        if (isset($_GET['GitFolder'])) {
            generateAlertBox("A \".git\" folder has been found and can't be delete automaticly. Please delete it manualy.", "error", "index.php");
        }
        ?>
        <div class="TopGrid">
            <div class="LeftSectionTopGrid">
                <div id="ProgressBarContener">
                    <div id="ProgressionBar">
                        <div id="ProgressionBarInner"></div>
                    </div>
                </div>
            </div>
            <div class="CenterSectionTopGrid">
                <img src="img/Logo.png" width="40px" height="40px" class="LogoTitle" />
                <h1 id="waveText"> <span>P</span><span>r</span><span>o</span><span>j</span><span>e</span><span>c</span><span>t</span><span>P</span><span>u</span><span>l</span><span>s</span><span>e</span></h1>
            </div>
            <div class="RightSectionTopGrid">
            </div>
        </div>
        <h2>
            You will find here, all the projects that you have created and that are in development. You can also create a new project or modify the characteristics of an existing project.
        </h2>
        <div id="VisibleCardPart" class="Separator"></div>
        <div class="center">
            <div class="navbar">
                <h2 class="ReasearchTitle">Make a research : </h2>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Research a project..." id="search-box">
                </div>
                <button id="NavbarHelper"><i class="fas fa-info-circle popover-icon"></i></button>

            </div>
            <div id="loader" class=" hidden"><i class="fa-solid fa-c"></i></div>
            <div id="error-message" class="alert error" style="display: none;">
                Aucun projet trouvé.
            </div>
        </div>

        <div class="Separator"></div>
        <h1>Visible projects</h1>
        <?php
        if (is_dir("Projects/")) {
            $dossiers = scandir("Projects/");

            $dossiers_utiles = array_filter($dossiers, function ($dossier) {
                return $dossier != "." && $dossier != "..";
            });

            if (empty($dossiers_utiles)) { ?>
                <h3>No project found.</h3>
            <?php
            } else { ?>
                <div class="card-grid" id="VisibleCardGrid">
                </div>
            <?php
            }
        } else { ?>
            <h3>No "Projects" folder.</h3>
        <?php
        }
        ?>

        <div class="secret hidden" id="secret">
            <div class="smooth-link"></div>
            <div id="HiddenCardPart" class="Separator"></div>
            <h1>Hidden projects</h1>

            <div class="card-grid" id="HiddenCardGrid">
            </div>
        </div>

    </div>

    <footer>
        <div class="BottomButton">
            <div class="StartBottomButton">
                <div id="FooterForm">
                    <form id="themeForm" method="post">
                        <select name="theme" id="theme" class="SelectTheme">
                            <option value="light" <?= $localData["theme"] == "light" ? "selected" : "" ?>>Light</option>
                            <option value="dark" <?= $localData["theme"] == "dark" ? "selected" : "" ?>>Dark</option>
                        </select>
                    </form>
                </div>
                <div id="GitHubIssueDiv"><a href="https://github.com/MarcusIsLion/ProjectPulse/issues/new" target="_blank" class="IssueBadge"><img src="https://img.shields.io/badge/issue-error-red?logo=x-circle" alt="badge to acces to the issue form" /></a></div>
            </div>
            <div class="CenterBottomButton">
                <a href="page/CreateNewProject.php" class="button GeneralButton">Create a new project</a>

                <a class="button SecretManager GeneralButton smooth-link" href="#HiddenCardGrid">See hidden projects <i class="fa-solid fa-eye"></i></a>
            </div>
            <div class="EndBottomButton">
                <div id="GitHubDiv"><a href="https://github.com/MarcusIsLion" target="_blank" class="GithubBadge"><img src="https://img.shields.io/badge/GitHub-MarcusIsLion-blue?logo=github" alt="badge reprensenting the github account of the developper" /></a></div>
            </div>
        </div>
    </footer>

    <script src="js/HiddenElementGestion.js"></script>
    <script src="js/WavingTextJS.js"></script>
    <script src="js/CardDisplayManagment.js"></script>
    <script src="js/CheckInternetConnection.js"></script>
    <script src="js/SmoothScrool.js"></script>
    <script src="js/ThemeGestion.js"></script>
    <script src="js/ResearchBar.js"></script>
    <script src="js/NavBarHelperGestion.js"></script>
</body>

</html>