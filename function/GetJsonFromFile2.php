<?php
///<sumary>
/// Get the JSON content from a file
///</sumary>
///<param name="$filePath">The path of the JSON file</param>
///<returns>The JSON content</returns>
///<exception>Exception if the file doesn't exist</exception>
function getJsonFromFile($filePath)
{
    if (!file_exists($filePath)) {
        return null;
    } else {
        $json = file_get_contents($filePath);
        return $json;
    }
}

echo getJsonFromFile($_GET["path"]);