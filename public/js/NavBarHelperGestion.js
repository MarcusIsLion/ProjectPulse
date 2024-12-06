const navBarShow = document.getElementById("NavbarHelper");
const navBarHide = document.getElementById("NavbarHelperCloser");
const bodyHidder = document.getElementById("Hidder");
const navbar = document.getElementById("popover_navbar");

navBarShow.addEventListener("click", () => {
    bodyHidder.style.display = "block";
    navbar.style.display = "block";
});

navBarHide.addEventListener("click", () => {
    bodyHidder.style.display = "none";
    navbar.style.display = "none";
});
