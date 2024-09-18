//Liens smooth dans la page
const smoothLinks = document.querySelectorAll(".smooth-link");

smoothLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
        e.preventDefault();

        const targetId = this.getAttribute("href");
        const targetElement = document.querySelector(targetId);

        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: "smooth",
            });
        }
    });
});
