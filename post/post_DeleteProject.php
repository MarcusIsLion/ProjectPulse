<?php

///<summary>
/// Delete a directory and its content, excluding .git folder and type.json if .git is found
///</summary>
///<param name="$dir">The path of the directory to delete</param>
///<param name="$hasGitFolder">Boolean indicating if a .git folder was found</param>
///<returns>True if the directory has been deleted, false otherwise</returns>
function deleteDirectory($dir, &$hasGitFolder)
{
    if (!is_dir($dir)) {
        return false; // Si le répertoire n'existe pas, on ne peut pas le supprimer
    }

    // Ouvrir le répertoire
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue; // Ignorer les dossiers spéciaux
        }

        $path = $dir . DIRECTORY_SEPARATOR . $item;

        if (is_dir($path)) {
            if ($item === '.git') {
                // Si le dossier rencontré est ".git", on ne le supprime pas
                $hasGitFolder = true; // On marque la présence du dossier .git
                continue;
            }

            // Si c'est un autre répertoire, on appelle récursivement la fonction
            deleteDirectory($path, $hasGitFolder);
        } else {
            // Si c'est un fichier, on vérifie si c'est "type.json"
            if ($item === 'type.json' && $hasGitFolder) {
                // Ne pas supprimer "type.json" si le dossier ".git" est trouvé
                continue;
            }

            // Sinon, on supprime le fichier
            unlink($path);
        }
    }

    // Après avoir supprimé le contenu, on peut supprimer le répertoire sauf si c'est le dossier racine (qui contient .git)
    if (basename($dir) !== '.git') {
        return rmdir($dir);
    }

    return true;
}

// Récupérer le chemin du répertoire du projet
$directory = $_GET['ProjectName'];
$hasGitFolder = false;

// Supprimer le répertoire tout en vérifiant la présence de .git
deleteDirectory($directory, $hasGitFolder);

// Redirection en fonction de la présence du dossier .git
if ($hasGitFolder) {
    header('Location: ../index.php?GitFolder=true');
} else {
    header('Location: ../index.php');
}

exit;
