// script.js
document.addEventListener("DOMContentLoaded", () => {
    const folders = document.querySelectorAll(".folder .folder-name");

    folders.forEach((folder) => {
        folder.addEventListener("click", () => {
            const contents = folder.nextElementSibling;

            if (
                contents.style.display === "none" ||
                contents.style.display === ""
            ) {
                contents.style.display = "block"; // Déplier
            } else {
                contents.style.display = "none"; // Replier
            }
        });
    });
});
