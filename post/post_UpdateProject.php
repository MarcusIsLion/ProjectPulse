<?php

// Getting the project name, type, state, visual and language from the form by POST method
$originalProjectName = $_POST["originalProjectName"];
$projectName = $_POST["projectName"];
$projectType = $_POST["projectType"];
$projectState = $_POST["projectState"];
$projectVisual = $_POST["projectVisual"];
$projectLanguage = $_POST["projectLanguage"];

// Define the path of the project directory
$originalDirectory = '../' . $originalProjectName;
$newDirectory = '../Projects/' . $projectName;

///<summary>
/// Delete a directory and its content
///</summary>
///<param name="$dir">The path of the directory to delete</param>
///<returns>True if the directory has been deleted, false otherwise</returns>
///<exception cref="Exception">If an error occurs during the deletion</exception>
try {
    // If the project name has changed, we rename the directory
    if ($originalProjectName !== $projectName && is_dir($originalDirectory)) {
        rename($originalDirectory, $newDirectory);
    }

    // Set the project directory to the new directory if it exists, otherwise keep the original directory
    $projectDirectory = is_dir($newDirectory) ? $newDirectory : $originalDirectory;
    $jsonFilePath = $projectDirectory . '/type.json';

    // Content of the type.json file
    $data = [
        "type" => $projectType,
        "state" => $projectState,
        "visual" => $projectVisual,
        "language" => $projectLanguage
    ];

    // Encode the data in JSON format
    $jsonContent = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($jsonFilePath, $jsonContent);

    // Redirect to the home page
    header('Location: ../index.php');
    exit;
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
    exit;
}
