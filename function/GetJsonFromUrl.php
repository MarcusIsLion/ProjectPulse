<?php
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
