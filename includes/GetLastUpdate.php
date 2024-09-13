<?php
function getLastUpdate($path)
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
    $lastUpdate = (int)$lastUpdate;
    $lastUpdate = date("d/m/Y", $lastUpdate);
    return $lastUpdate;
}
