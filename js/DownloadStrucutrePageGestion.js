const cancelButton = document.getElementById("cancelButton");
const CreateNewStructureButton = document.getElementById("CreateNewStructure");

cancelButton.addEventListener("click", () => {
    window.location.href = "CreateNewProject.php";
});

CreateNewStructureButton.addEventListener("click", () => {
    window.location.href = "CreateStructurePage.php";
});
