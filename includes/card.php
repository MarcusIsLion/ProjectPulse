<?php

declare(strict_types=1);

require_once("../Interface/ICard.php");

class card implements ICard
{
    #region Attributes
    private $folder; // Name of the folder
    private $fullPath; // Full path of the folder
    private $LanguageIdPopover; // Id of the popover
    private $typeData; // Type of the project
    #endregion

    #region Constructor
    /**
     * Constructor of the class card
     * @param string $folder Name of the folder
     * @param string $full_path Full path of the folder
     * @param int $LanguageIdPopover Id of the popover
     * @param string $typeData Type of the project
     * @return void
     */
    public function __construct(string $folder, string $full_path, int $LanguageIdPopover, string $typeData)
    {
        $this->folder = $folder;
        $this->fullPath = $full_path;
        $this->LanguageIdPopover = $LanguageIdPopover;
        $this->typeData = $typeData;
    }
    #endregion

    #region Properties
    /**
     * Get the folder project
     * @return string
     */
    public function getFolder(): string
    {
        return $this->folder;
    }

    /**
     * Get the full path of the project
     * @return string
     */
    public function getFullPath(): string
    {
        return $this->fullPath;
    }

    /**
     * Get the id of the popover
     * @return int
     */
    public function getLanguageIdPopover(): int
    {
        return $this->LanguageIdPopover;
    }

    /**
     * Get the type of the project
     * @return string
     */
    public function getTypeData(): string
    {
        return $this->typeData;
    }
    #endregion

    #region Methods
    /**
     * Find the logo of the project
     * @param string $basePath Base path of the project
     * @return string|null
     */
    private function findLogo($basePath): ?string
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

    /**
     * Get the last update of the project
     * @param string $path Path of the project
     * @return string
     */
    private function getLastUpdate($path): string
    {
        $lastUpdate = 0;
        $dir = opendir($path);
        while ($file = readdir($dir)) {
            if ($file != '.' && $file != '..') {
                if (is_dir($path . '/' . $file)) {
                    $lastUpdate = max($lastUpdate, $this->GetLastUpdate($path . '/' . $file));
                } else {
                    $lastUpdate = max($lastUpdate, filemtime($path . '/' . $file));
                }
            }
        }
        closedir($dir);
        $lastUpdate = (int)$lastUpdate;
        $lastUpdate = date("d/m/Y", $lastUpdate);
        return $lastUpdate;
    }

    /**
     * Format the size of the project
     * @param string $octets Size of the project
     * @return string
     */
    private function formatSizeUnits($octets): string
    {
        if ($octets >= 1073741824) {
            $octets = number_format($octets / 1073741824, 2) . ' GB';
        } elseif ($octets >= 1048576) {
            $octets = number_format($octets / 1048576, 2) . ' MB';
        } elseif ($octets >= 1024) {
            $octets = number_format($octets / 1024, 2) . ' KB';
        } elseif ($octets > 1) {
            $octets = $octets . ' bytes';
        } elseif ($octets == 1) {
            $octets = $octets . ' byte';
        } else {
            $octets = '0 bytes';
        }
        return $octets;
    }

    /**
     * Get folder size
     * @param string $path Path of the folder
     * @return null|float
     */
    private function getFolderSize($path): ?float
    {
        $totalSize = 0;
        $files = scandir($path);
        foreach ($files as $t) {
            if (
                $t != "." && $t != ".."
            ) {
                if (is_dir($path . "/" . $t)) {
                    $totalSize += $this->getFolderSize($path . "/" . $t); // Addition avant formatage
                } else {
                    $totalSize += filesize($path . "/" . $t);
                }
            }
        }
        return round($totalSize, 2); // Formatage à la fin
    }

    /**
     * Generate the HTML of the card
     * @param string $folder Base folder of the project
     * @param string $fullPath Full path of the folder
     * @param string $LanguageIdPopover Id of the popover
     * @param string $typeData Type of the project
     * @return string
     */
    private function generateCardHTML($folder, $full_path, $LanguageIdPopover, $typeData): string
    {
        // Vérification si $chemin_complet est valide
        if (empty($full_path) || !is_dir($full_path)) {
            return '<div class="card error">Chemin invalide ou dossier non trouvé.
        </div>';
        }

        // Récupération des informations de taille, dates, et type
        $logo = $this->findLogo($full_path);
        $size = $this->formatSizeUnits($this->getFolderSize($full_path));
        $createdAt = date("d/m/Y", filectime($full_path));
        $updatedAt = $this->getLastUpdate($full_path);
        $fileCount = count(scandir($full_path));
        $folderCount = count(glob($full_path . '/*', GLOB_ONLYDIR));


        // Construction du HTML à retourner
        if ($typeData == null) {
            $html = '<div class="card error">';
            $typeData = '{"type":"Error","state":"Error","language":"Error"}';
            $html .= '<div class="alertbox error"><a href="page/CreateJSONFile.php?ProjectName=' .  htmlspecialchars($folder) . '"><i class="fa-solid fa-triangle-exclamation"></i><p> The json file for this project was not found. <br/> Click here to create the json file </p><i class="fa-solid fa-triangle-exclamation"></i></a></div>';
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
        $html .= '<h2 class="card-title">' . htmlspecialchars($folder, ENT_QUOTES) . '</h2>';
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
                <p class="ProjectType">Type : ' . $type . '</p>';
        $html .= '<div class="icon-container">';
        $html .= '<button class="NotButton"><i class="fas fa-info-circle popover-icon"></i></button>';
        $html .= '<div class="popover" id="LanguageIdPopover' . $LanguageIdPopover . '"><p class="projectLanguage">' . $language . '</p></div>';
        $html .= '</div>
            </li>';
        $html .= '<li class="' . htmlspecialchars($state, ENT_QUOTES) . '">';
        $html .= '<p class="projectState">State : ' . $stateFromJson . '</p>';
        $html .= '</li>
        </ul>';

        $html .= '<div class="CardButtonSection">';
        $html .= '<a href="' . htmlspecialchars($full_path, ENT_QUOTES) . '" class="button">Open this project</a>';
        $html .= '<a href="page/UpdateProject.php?ProjectName=' . htmlspecialchars($full_path, ENT_QUOTES) . '" class="button">Update these characteristics</a>';
        $html .= '</div></div></div>';

        return $html;
    }

    /**
     * Convert the object to a string
     * @return string
     */
    public function __toString(): string
    {
        return $this->generateCardHTML($this->getFolder(), $this->getFullPath(), $this->getLanguageIdPopover(), $this->getTypeData());
    }
    #endregion
}

$card = new Card($_GET["folder"], $_GET["full_path"], intval($_GET["LanguageIdPopover"]), $_GET["typeData"]);

echo $card->__toString();
