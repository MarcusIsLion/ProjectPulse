<?php
// Get the project name, type and language from the form by POST method
$projectName = $_POST["projectName"];
$projectType = $_POST["projectType"];
$projectLanguage = $_POST["projectLanguage"];

// Define the path of the project directory
$projectDirectory = '../Projects/' . $projectName;

include_once("../function/CreateProjectBase.php");

// Create the project
CreateProjectBase($projectLanguage, $projectName, $projectType, $projectDirectory);

// Redirect to the project page
header('Location: ../Projects/' . $projectName);
exit;
