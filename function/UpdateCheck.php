<?php
// This file is used to check if the version of the project is up to date or not.

include_once("GetJsonFromFile.php");

///<sumary>
/// Get the JSON content from an URL
///</sumary>
///<param name="$url">The URL of the JSON file</param>
///<returns>The JSON content</returns>
///<exception>Exception if the file can't be retrieved</exception>
function getJsonFromUrl($url)
{
    $json = file_get_contents($url);
    if ($json === false) {
        throw new Exception("Impossible to get the file at the URL : $url");
    }
    return json_decode($json, true);
}

///<sumary>
/// Check if the version of the project is up to date
///</sumary>
///<returns>True if the version is up to date, false otherwise</returns>
///<exception>Exception if an error occurs</exception>
function CheckVersions()
{
    try {
        // URL of the version.json file on GitHub
        $githubJsonUrl = 'https://raw.githubusercontent.com/MarcusIsLion/ProjectPulse/main/data/version.json';

        // Path of the version.json file on the local
        $localJsonPath = 'data/version.json';

        // Getting the version from the GitHub file
        $githubData = getJsonFromUrl($githubJsonUrl);
        $githubVersion = $githubData['version'];

        // Getting the version from the local file
        $localData = getJsonFromFile($localJsonPath);
        $localVersion = $localData['version'];

        // Comparing the versions
        if ($githubVersion === $localVersion) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
