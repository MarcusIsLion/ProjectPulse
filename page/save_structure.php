<?php

require_once("../function/GetJsonFromFile.php");

// Récupérer les données JSON du fichier ProjectLanguage.json
$localData = getJsonFromFile("../data/enum/ProjectLanguage.json");

// Vérifiez si le fichier a été lu correctement
if ($localData === false) {
    echo json_encode(["status" => "error", "message" => "Failed to read data file."]);
    exit;
}

// Je récupère l'id le plus grand à partir de l'id 1000
$lastId = 1000;
foreach ($localData as $key => $value) {
    if ($value["id"] > $lastId) {
        $lastId = $value["id"];
    }
}

// Récupérer les données JSON envoyées par le client
$data = file_get_contents("php://input");
$data = json_decode($data, true);

// Vérifiez si les données ont été décodées correctement
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON received."]);
    exit;
}

// Ajouter un nouvel ID
$data['id'] = (string)++$lastId;

// Vérifier si des données sont présentes
if (!empty($data)) {
    // Ajouter les nouvelles données à la structure existante dans un try catch
    try {
        $localData[] = $data;
        file_put_contents("../data/enum/ProjectLanguage.json", json_encode($localData, JSON_PRETTY_PRINT));
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Failed to save data."]);
        exit;
    }

    // Répondre au client pour confirmer la sauvegarde
    echo json_encode(["status" => "success", "message" => "File saved successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "No data received"]);
}
