<?php
if (isset($_POST['theme'])) {
    $theme = $_POST['theme'];
    $data = file_get_contents("../data/version.json");
    $data = json_decode($data, true);
    $data["theme"] = $theme;
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("../data/version.json", $data);
    header("Location: ../index.php");
} else {
    header("Location: ../index.php");
}
