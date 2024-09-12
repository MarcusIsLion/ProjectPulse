<?php
require_once("../function/GetLastUpdate.php");
function generateCardHTML($logo, $dossier, $chemin_complet, $LanguageIdPopover)
{
    // Récupération des informations de taille, dates, et type
    $size = formatSizeUnits(getFolderSize($chemin_complet));
    $createdAt = date("d/m/Y", filectime($chemin_complet));
    $updatedAt = GetLastUpdate($chemin_complet);
    $fileCount = count(scandir($chemin_complet));
    $folderCount = count(glob($chemin_complet . '/*', GLOB_ONLYDIR));

    // Lecture des informations du fichier JSON
    $typeData = json_decode(file_get_contents($chemin_complet . "/type.json"));
    if ($typeData == null) {
        $visual = "hidden";
        $state = "error";
        $type = "error";
        $language = "error";
        $stateFromJson = "error";
    } else {
        $visual = $typeData->visual;
        $state = $typeData->state;
        $type = $typeData->type;
        $language = $typeData->language;
        $stateFromJson = $typeData->state;
    }

    // Construction du HTML à retourner
    if ($typeData == null) {
        $html = '<div class="card error">';
    } else {
        $html = '<div class="card">';
    }

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
