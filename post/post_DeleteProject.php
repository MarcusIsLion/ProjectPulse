<?php
// je recois par le get le nom du dossier à supprimer en concaténant ../ et $_GET['ProjectName']

function deleteDirectory($dir)
{
    if (!is_dir($dir)) {
        return false; // Si ce n'est pas un répertoire, on quitte.
    }

    // Ouvrir le répertoire.
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue; // Ignorer les répertoires '.' et '..'.
        }

        $path = $dir . DIRECTORY_SEPARATOR . $item;

        if (is_dir($path)) {
            // Si c'est un sous-répertoire, on le supprime récursivement.
            deleteDirectory($path);
        } else {
            // Sinon, on supprime le fichier.
            unlink($path);
        }
    }

    // Après avoir supprimé tous les fichiers et sous-répertoires, on peut supprimer le répertoire.
    return rmdir($dir);
}

// Exemple d'utilisation
$directory = '../' . $_GET['ProjectName'];
deleteDirectory($directory);

// je redirige l'utilisateur vers index.php
header('Location: ../index.php');
exit;
