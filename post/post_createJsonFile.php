<?php

require_once("../function/CreateJsonFile.php");

createJsonFile($_POST["projectDirectory"], $_POST["projectType"], $_POST["projectState"], $_POST["projectVisual"], $_POST["projectLanguage"]);
header("Location: ../index.php");
exit();
