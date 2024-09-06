// code js qui permet d'alterner entre cet élément : "<i class="fa-solid fa-eye"></i><i class="fa-solid fa-eye-slash"></i>" et celui-ci : <i class="fa-solid fa-eye"></i><i class="fa-solid fa-eye-slash"></i> lorsqu'ils sont cliqués et retirer la class CSS "hidden" des élements qui la possède dans la page
const button = document.getElementsByClassName("SecretManager")[0];

// Fonction qui permet de changer l'icone de l'oeil
function changeIcone(icone) {
    if (icone.classList.contains("fa-eye")) {
        button.innerText = "Hide hidden projects ";
        button.appendChild(icone);
        icone.classList.remove("fa-eye");
        icone.classList.add("fa-eye-slash");
    } else {
        button.innerText = "Show hidden projects ";
        button.appendChild(icone);
        icone.classList.remove("fa-eye-slash");
        icone.classList.add("fa-eye");
    }
}

// Fonction qui permet de toggle la class "hidden" des éléments qui la possède
function ManageHiddenClass() {
    let elements = document.getElementsByClassName("secret");
    for (let i = 0; i < elements.length; i++) {
        elements[i].classList.toggle("hidden");
    }
}

// j'ajoute un écouteur d'événement sur le document pour écouter les clics sur les boutons ayant la class "SecretManager"
// document.addEventListener("click", function (event) {
button.addEventListener("click", function (event) {
    // let button = event.target.closest(".SecretManager");
    if (button) {
        let icone = button.getElementsByTagName("i")[0];
        changeIcone(icone);
        ManageHiddenClass();
    }
});
