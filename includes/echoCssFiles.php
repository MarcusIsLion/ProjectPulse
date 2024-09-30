<?php
function echoCssFiles($cssPath)
{
    $cssFiles = glob($cssPath . "*.css");
    foreach ($cssFiles as $cssFile) {
        echo "<link rel=\"stylesheet\" href=\"$cssFile\" />\n";
    }
}
