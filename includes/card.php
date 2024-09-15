<?php
require_once("GetLastUpdate.php");
require_once("GetFolderSize.php");

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

function generateCardHTML($dossier, $chemin_complet, $LanguageIdPopover, $typeData)
{
    // Vérification si $chemin_complet est valide
    if (empty($chemin_complet) || !is_dir($chemin_complet)) {
        return '<div class="card error">Chemin invalide ou dossier non trouvé.
        </div>';
    }

    // Récupération des informations de taille, dates, et type
    $logo = findLogo($chemin_complet);
    $size = formatSizeUnits(getFolderSize($chemin_complet));
    $createdAt = date("d/m/Y", filectime($chemin_complet));
    $updatedAt = getLastUpdate($chemin_complet);
    $fileCount = count(scandir($chemin_complet));
    $folderCount = count(glob($chemin_complet . '/*', GLOB_ONLYDIR));


    // Construction du HTML à retourner
    if ($typeData == null) {
        $html = '<div class="card error">';
        $typeData = '{"type":"Error","state":"Error","language":"Error"}';
        $html .= '<div class="alertbox error"><a href="index.php"><i class="fa-solid fa-triangle-exclamation"></i> The json file for this project was not found. <i class="fa-solid fa-triangle-exclamation"></i></a></div>';
    } else {
        $html = '<div class="card">';
    }

    $typeData = json_decode($typeData);
    $type = $typeData->type;
    $state = $typeData->state;
    $stateFromJson = $state;
    $language = $typeData->language;


    if ($logo) {
        $html .= '<div class="logo-background" style="background-image: url(\'' . htmlspecialchars($logo, ENT_QUOTES) . '\');"></div>';
    }

    $html .= '<div class="CardContent">';
    $html .= '<h2>' . htmlspecialchars($dossier, ENT_QUOTES) . '</h2>';
    $html .= '<ul>';
    $html .= '<li>
                <p>Size : ' . $size . '</p>
            </li>';
    $html .= '<li>
                <p>Created at : ' . $createdAt . '</p>
            </li>';
    $html .= '<li>
                <p>Updated at : ' . $updatedAt . '</p>
            </li>';
    $html .= '<li>
                <p>' . $fileCount . ' files / ' . $folderCount . ' folders</p>
            </li>';
    $html .= '<li>
                <p>Type : ' . $type . '</p>';
    $html .= '<div class="icon-container">';
    $html .= '<button onclick="afficherPopover(\'LanguageIdPopover' . $LanguageIdPopover . '\')" class="NotButton"><i class="fas fa-info-circle popover-icon"></i></button>';
    $html .= '<div class="popover hidden" id="LanguageIdPopover' . $LanguageIdPopover . '">' . $language . '</div>';
    $html .= '</div>
            </li>';
    $html .= '<li class="' . htmlspecialchars($state, ENT_QUOTES) . '">';
    $html .= '<p>State : ' . $stateFromJson . '</p>';
    $html .= '</li>
        </ul>';

    $html .= '<div class="CardButtonSection">';
    $html .= '<a href="' . htmlspecialchars($chemin_complet, ENT_QUOTES) . '" class="button">Open this project</a>';
    $html .= '<a href="page/UpdateProject.php?ProjectName=' . htmlspecialchars($chemin_complet, ENT_QUOTES) . '" class="button">Update these characteristics</a>';
    $html .= '</div>
    </div>
</div>';

    return $html;
}
echo generateCardHTML($_GET['dossier'], $_GET['chemin_complet'], $_GET['LanguageIdPopover'], $_GET['typeData']);
