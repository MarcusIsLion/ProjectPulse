// Permet le drop dans une zone donnée
function allowDrop(ev) {
    ev.preventDefault(); // Par défaut, le drop est désactivé, il faut donc l'autoriser
}

// Capture l'élément glissé
function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id); // Stocke l'id de l'élément déplacé
}

function drop(ev) {
    ev.preventDefault();
    ev.stopPropagation();

    var data = ev.dataTransfer.getData("text");

    // Ajout d'une vérification pour permettre le drop dans les dossiers
    if (
        !ev.target.classList.contains("folder-container") &&
        !ev.target.classList.contains("folder") &&
        ev.target.id !== "drop-zone"
    ) {
        alert("Vous devez déposer les éléments dans la zone de construction.");
        return;
    }

    var newElement = document.createElement("div");
    newElement.classList.add("dropped-item");

    var elementType = data === "folder" ? "Dossier" : "Fichier";
    var elementName = prompt("Entrez le nom du " + elementType + ":");

    if (elementName) {
        var icon = document.createElement("span");
        icon.classList.add("material-icons");
        icon.classList.add("icon");

        if (data === "folder") {
            icon.innerText = "folder";
            newElement.classList.add("folder");
        } else {
            // Garder le nom complet du fichier (nom + extension)
            var extension = elementName.split(".").pop().toLowerCase();
            const iconMap = {
                html: "html",
                css: "css",
                js: "javascript",
                jpg: "image",
                jpeg: "image",
                png: "image",
                gif: "image",
                pdf: "picture_as_pdf",
                php: "php",
                sql: "storage",
                md: "description",
                txt: "description",
                json: "description",
                xml: "description",
                zip: "archive",
                rar: "archive",
            };
            icon.innerText = iconMap[extension] || "insert_drive_file";
            newElement.classList.add("file");
        }

        newElement.appendChild(icon);

        // Afficher le nom complet du fichier (nom + extension)
        var nameSpan = document.createElement("span");
        nameSpan.innerText = " " + elementName + (data === "folder" ? "/" : "");
        newElement.appendChild(nameSpan);

        var deleteButton = document.createElement("button");
        deleteButton.innerText = "X";
        deleteButton.classList.add("delete-button");
        deleteButton.onclick = function () {
            deleteItem(newElement);
        };
        newElement.appendChild(deleteButton);

        // Permet de déposer des éléments dans des sous-dossiers ou la zone principale
        if (ev.target.classList.contains("folder")) {
            ev.target.appendChild(newElement);
        } else {
            document.getElementById("drop-zone").appendChild(newElement);
        }
    } else {
        alert("Le nom ne peut pas être vide.");
    }
}

// Fonction pour supprimer un élément (dossier ou fichier)
function deleteItem(element) {
    var parent = element.parentElement;

    // Vérifier si l'élément est un dossier
    if (element.classList.contains("folder")) {
        // Supprimer récursivement tous les enfants du dossier
        while (element.firstChild) {
            deleteItem(element.firstChild); // Appel récursif pour supprimer les enfants
        }
    }

    // Supprimer l'élément lui-même
    parent.removeChild(element);
}

function createStructure(dropZone) {
    var folders = {};
    var files = [];
    var folderElements = dropZone.children;

    Array.from(folderElements).forEach(function (element) {
        if (element.classList.contains("folder")) {
            var spanElement = element.querySelectorAll("span");
            if (spanElement) {
                var folderName = spanElement[1].innerText.trim();
                folderName = folderName.replace("/", ""); // Supprimer le "/" à la fin du nom
                folderName = folderName.replace("\\", "");
                folders[folderName] = {
                    name: folderName,
                    folders: createSubFolders(element), // Récupère les sous-dossiers
                    files: getFiles(element), // Récupère les fichiers dans le dossier
                };
            }
        } else if (element.classList.contains("file")) {
            var fileName = element.querySelectorAll("span")[1].innerText.trim();
            files.push(fileName); // Ajoute le fichier à la liste des fichiers
        }
    });

    return {
        folders: folders,
        files: files,
    };
}

// Fonction pour récupérer les fichiers à partir d'un dossier
function getFiles(folder) {
    var files = [];
    var fileElements = folder.getElementsByClassName("file");
    Array.from(fileElements).forEach(function (file) {
        var fileName = file.querySelectorAll("span")[1].innerText.trim();
        files.push(fileName);
    });

    return files;
}

// Fonction pour créer des sous-dossiers
function createSubFolders(folder) {
    var subFolders = {};
    var folderChildren = folder.children;

    Array.from(folderChildren).forEach(function (child) {
        if (child.classList.contains("folder")) {
            var folderName = child.querySelectorAll("span")[1].innerText.trim();
            folderName = folderName.replace("/", ""); // Supprimer le "/" à la fin du nom
            folderName = folderName.replace("\\", "");
            subFolders[folderName] = {
                name: folderName,
                folders: createSubFolders(child), // Récursivement récupérer les sous-dossiers
                files: getFiles(child), // Récupérer les fichiers
            };
        }
    });

    return subFolders;
}

const StructureNameInput = document.getElementById("StructureName");
const StrucutreLanguagesInput = document.getElementById("StructureType");
const RegisterErrorLabel = document.getElementById("RegisterError");
RegisterErrorLabel.classList.add("visible");

const ConstructionZoneArea = document.getElementById("ConstructionZone");

StructureNameInput.addEventListener("input", function () {
    if (StructureNameInput.value != "" && StrucutreLanguagesInput.value != "") {
        RegisterErrorLabel.classList.remove("visible");
        setTimeout(() => {
            RegisterErrorLabel.style.display = "none";
        }, 500);
        setTimeout(() => {
            ConstructionZoneArea.classList.add("visible");
        }, 500);
    } else {
        ConstructionZoneArea.classList.remove("visible");
        setTimeout(() => {
            RegisterErrorLabel.style.display = "flex";
        }, 500);
        setTimeout(() => {
            RegisterErrorLabel.classList.add("visible");
        }, 100);
    }
});

StrucutreLanguagesInput.addEventListener("input", function () {
    if (StructureNameInput.value != "" && StrucutreLanguagesInput.value != "") {
        RegisterErrorLabel.classList.remove("visible");
        setTimeout(() => {
            RegisterErrorLabel.style.display = "none";
        }, 500);
        setTimeout(() => {
            ConstructionZoneArea.classList.add("visible");
        }, 500);
    } else {
        ConstructionZoneArea.classList.remove("visible");
        setTimeout(() => {
            RegisterErrorLabel.style.display = "flex";
        }, 500);
        setTimeout(() => {
            RegisterErrorLabel.classList.add("visible");
        }, 100);
    }
});

const submitbutton = document.getElementById("submitbutton");
submitbutton.addEventListener("click", function () {
    try {
        var structure = createStructure(document.getElementById("drop-zone"));
        // #
        StructureNameInput.value = StructureNameInput.value.replace("#", "%23");

        // Structure de base du JSON
        var jsonOutput = {
            id: "2", // Vous pouvez générer ou récupérer un ID dynamique
            author: "LocalDev", // Nom de l'auteur
            name: StructureNameInput.value,
            language: StrucutreLanguagesInput.value, // Modifiez selon vos besoins
            value: StructureNameInput.value.replace(/\s+/g, ""), // Supprime les espaces pour un ID
            FolderNedded: {
                base: {
                    name: "base", // Nom du dossier racine
                    folders: structure.folders, // Structure des dossiers générée dynamiquement
                    files: structure.files, // Structure des fichiers générée dynamiquement
                },
            },
        };

        // Requête AJAX pour envoyer le JSON au serveur
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "save_structure.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    alert("Structure saved successfully!");
                } else {
                    console.error(
                        "Erreur lors de l'envoi du JSON:",
                        xhr.responseText
                    );
                    alert("Erreur lors de l'enregistrement de la structure.");
                }
            }
        };

        xhr.send(JSON.stringify(jsonOutput));
        window.location.href = "CreateNewProject.php";
    } catch (error) {
        alert("Erreur lors de la création de la structure.");
    }
});

const cancelbutton = document.getElementById("cancelbutton");

cancelbutton.addEventListener("click", function () {
    window.location.href = "DownloadStructure.php";
});
