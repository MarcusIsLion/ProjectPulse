<?php

function generateFileTree(string $path): string
{
    if (!is_dir($path)) {
        return "<p>Le chemin spécifié n'est pas un répertoire valide.</p>";
    }

    $html = "<ul>";

    // Parcourir les dossiers et fichiers
    $items = array_diff(scandir($path), ['.', '..']);
    foreach ($items as $item) {
        $fullPath = $path . DIRECTORY_SEPARATOR . $item;

        if (is_dir($fullPath)) {
            // Dossier : appeler récursivement
            $html .= "<li class='folder' data-path='$fullPath'>
                        <span class='folder-name'>$item</span>
                        <div class='folder-contents' style='display: none;'>"
                . generateFileTree($fullPath) .
                "</div>
                    </li>";
        } else {
            // Fichier : vérifier s'il s'agit d'un fichier d'entrée (index.html, index.php)
            $isEntryPoint = in_array($item, ['index.html', 'index.php', 'index.htm']);

            if ($isEntryPoint) {
                // Construire le chemin relatif pour le fichier d'entrée
                $relativePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $fullPath);

                // S'assurer que le lien est correctement formé avec un slash initial
                $relativePath = '/' . ltrim($relativePath, '/');

                $relativePath = str_replace('C:\xampp\htdocs\\', '', $relativePath);

                $html .= "<li class='file entry-point' data-path='$fullPath'>
                            <a href='$relativePath' target='_blank' class='file-name'>$item</a>
                          </li>";
            } else {
                // Fichier ordinaire
                $html .= "<li class='file' data-path='$fullPath'>
                            <span class='file-name'>$item</span>
                          </li>";
            }
        }
    }

    $html .= "</ul>";
    return $html;
}
