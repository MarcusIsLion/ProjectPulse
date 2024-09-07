// This script is used to manage the hidden elements of the page

const button = document.getElementsByClassName("SecretManager")[0]; // Get the first element with the class "SecretManager"

///<summary>
/// Function that changes the icon of the button
///</summary>
///<param name="icone">The icon to change</param>
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

///<summary>
/// Function that manages the hidden class of the elements
///</summary>
function ManageHiddenClass() {
    let elements = document.getElementsByClassName("secret");
    for (let i = 0; i < elements.length; i++) {
        elements[i].classList.toggle("hidden");
    }
}

// Add an event listener to the button
button.addEventListener("click", function (event) {
    if (button) {
        let icone = button.getElementsByTagName("i")[0];
        changeIcone(icone);
        ManageHiddenClass();
    }
});
