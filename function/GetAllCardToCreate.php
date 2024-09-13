<?php
//file to get all folders in the "Projects" folder
function GetAllFolder()
{
    $path = "../Projects";
    $folders = array_diff(scandir($path), array('..', '.'));
    return $folders;
}

echo json_encode(GetAllFolder());
