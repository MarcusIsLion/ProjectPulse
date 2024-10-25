<?php

function createJsonFile($projectDirectory, $projectType, $projectState, $projectVisual, $projectLanguage)
{
    try {
        $projectJson = array(
            "type" => htmlspecialchars($projectType),
            "state" => htmlspecialchars($projectState),
            "visual" => htmlspecialchars($projectVisual),
            "language" => htmlspecialchars($projectLanguage),
        );
        file_put_contents($projectDirectory . "/type.json", json_encode($projectJson));
    } catch (Exception $e) {
        throw new Exception("Error while creating the JSON file: " . $e->getMessage());
    }
}
