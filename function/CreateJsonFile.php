<?php

function createJsonFile($projectDirectory, $projectType, $projectState, $projectVisual, $projectLanguage)
{
    try {
        $projectJson = array(
            "type" => $projectType,
            "state" => $projectState,
            "visual" => $projectVisual,
            "language" => $projectLanguage,
        );
        file_put_contents($projectDirectory . "/type.json", json_encode($projectJson));
        header("Location: ../index.php");
    } catch (Exception $e) {
        throw new Exception("Error while creating the JSON file: " . $e->getMessage());
    }
}
