<?php

// create a function that is searching for the last update of a project folder, thats mean the last update of the files in the folder and subfolders
function GetLastUpdate($path)
{
    $lastUpdate = 0;
    $dir = opendir($path);
    while ($file = readdir($dir)) {
        if ($file != '.' && $file != '..') {
            if (is_dir($path . '/' . $file)) {
                $lastUpdate = max($lastUpdate, GetLastUpdate($path . '/' . $file));
            } else {
                $lastUpdate = max($lastUpdate, filemtime($path . '/' . $file));
            }
        }
    }
    closedir($dir);
    return $lastUpdate;
}
