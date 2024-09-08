<?php
///<sumary>
/// Check if internet is availible with google DNS
///</sumary>
///<return>True if there is a connexion, false in an other case</return>
function isInternetAvailable()
{

    $host = '8.8.8.8';
    $port = 53;
    $timeout = 1;

    $connection = @fsockopen($host, $port, $errno, $errstr, $timeout);

    if ($connection) {
        fclose($connection);
        return true;
    } else {
        return false;
    }
}
