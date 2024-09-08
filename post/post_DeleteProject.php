<?php
///<sumary>
/// Delete a directory and its content
///</sumary>
///<param name="$dir">The path of the directory to delete</param>
///<returns>True if the directory has been deleted, false otherwise</returns>
function deleteDirectory($dir)
{
    if (!is_dir($dir)) {
        return false; // If we can't find the directory, we can't delete it.
    }

    // Open the directory
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue; // Ignore the special directories
        }

        $path = $dir . DIRECTORY_SEPARATOR . $item;

        if (is_dir($path)) {
            // If it's a directory, we call the function recursively
            deleteDirectory($path);
        } else {
            // If it's a file, we delete it
            unlink($path);
        }
    }

    // After deleting all the content, we can delete the directory
    return rmdir($dir);
}

// Getting the path of the project directory
$directory = $_GET['ProjectName'];
deleteDirectory($directory);

// Redirect to the home page
header('Location: ../index.php');
exit;
