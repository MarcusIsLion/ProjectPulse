<?php
function getFolderSize($path)
{
    $totalSize = 0;
    $files = scandir($path);
    foreach ($files as $t) {
        if ($t != "." && $t != "..") {
            if (is_dir($path . "/" . $t)) {
                $totalSize += getFolderSize($path . "/" . $t);
            } else {
                $totalSize += filesize($path . "/" . $t);
            }
        }
    }
    return round($totalSize, 2);
}

function formatSizeUnits($octets)
{
    if ($octets >= 1073741824) {
        $octets = number_format($octets / 1073741824, 2) . ' GB';
    } elseif ($octets >= 1048576) {
        $octets = number_format($octets / 1048576, 2) . ' MB';
    } elseif ($octets >= 1024) {
        $octets = number_format($octets / 1024, 2) . ' KB';
    } elseif ($octets > 1) {
        $octets = $octets . ' bytes';
    } elseif ($octets == 1) {
        $octets = $octets . ' byte';
    } else {
        $octets = '0 bytes';
    }
    return $octets;
}
