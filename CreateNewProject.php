<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Créer un nouveau projet local</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
        <h1>Please, register informations to create your new project :</h1>
        <div class="Form-Grid-Container">
            <div class="Form-Grid">
                <form action="post/post_CreateNewProject.php" method="post">
                    <label for="projectName">Name of the project :</label>
                    <input type="text" id="projectName" name="projectName" placeholder="Name of the project" required /><br />
                    <label for="projectType">Type of project :</label>
                    <input type="text" id="projectType" name=" projectType" placeholder="Type of the project" required /><br />
                    <label for="projectLanguage">Language of the project :</label>
                    <select name="projectLanguage" id="projectLanguage">
                        <option value="HTMLCSSJS">HTML CSS JS</option>
                        <option value="NativePHP">Native PHP</option>
                        <option value="SymphoniePHP">PHP and Symphonie</option>
                        <option value="DockerSymphoniePHP">PHP, Symphonie and Docker</option>
                        <option value="LaravelPHP">PHP and Laravel</option>
                        <option value="NodeJS">NodeJS</option>
                        <option value="ReactJS">ReactJS</option>
                        <option value="AngularJS">AngularJS</option>
                        <option value="VueJS">VueJS</option>
                        <option value="Python">Python</option>
                        <option value="Ruby">Ruby</option>
                        <option value="Java">Java</option>
                        <option value="CSharp">C#</option>
                        <option value="CPlusPlus">C++</option>
                        <option value="C">C</option>
                        <option value="Rust">Rust</option>
                    </select><br />
                    <input type="submit" value="Create the project" class="button ValidationCreation" />
                </form>
            </div>
        </div>
        <a href="index.php">Cancel</a>
    </div>
</body>

</html>