<?php
function echoCssFiles(string $cssPath, array $cssFilesExclude = null)
{
    $cssFiles = glob($cssPath . "*.css");
    foreach ($cssFiles as $cssFile) {
        if ($cssFilesExclude !== null && in_array($cssFile, $cssFilesExclude)) {
            continue;
        } else {
            echo "<link rel=\"stylesheet\" href=\"$cssFile\" />";
        }
    }
}
