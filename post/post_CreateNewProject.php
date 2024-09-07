<?php
// Get the project name, type and language from the form by POST method
$projectName = $_POST["projectName"];
$projectType = $_POST["projectType"];
$projectLanguage = $_POST["projectLanguage"];

// Define the path of the project directory
$projectDirectory = '../Website/' . $projectName;

// Check if the project directory doesn't exist
if (!is_dir($projectDirectory)) {
    // Create the directory with the appropriate permissions (0777 for read, write, execute)
    mkdir($projectDirectory, 0777, true);

    // Content of the type.json file
    $data = [
        "type" => $projectType,
        "state" => "Development",
        "visual" => "visible",
        "language" => $projectLanguage
    ];

    // Encode the data in JSON format
    $jsonContent = json_encode($data, JSON_PRETTY_PRINT);

    // Path of the type.json file
    $jsonFilePath = $projectDirectory . '/type.json';

    // Create the type.json file with the JSON content
    file_put_contents($jsonFilePath, $jsonContent);
}

// Redirect to the project page
header('Location: ../Website/' . $projectName);
exit;
