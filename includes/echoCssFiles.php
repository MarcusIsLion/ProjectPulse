<?php
function echoCssFiles($cssPath)
{
    $cssFiles = glob($cssPath . "*.css");
    foreach ($cssFiles as $cssFile) {
        if (basename($cssFile) != "creationProject.css")
            echo "<link rel=\"stylesheet\" href=\"$cssFile\" />\n";
    }
}
