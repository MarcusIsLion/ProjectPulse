// Script pour la barre de recherche, et son affichage est déjà géré
const searchBox = document.getElementById("search-box");

function SearchCard() {
    const cards = document.querySelectorAll(".card");
    const searchValue = searchBox.value.toLowerCase();

    for (let i = 0; i < cards.length; i++) {
        const card = cards[i];
        card.style.display = "none";
        const cardTitle = card
            .querySelector(".card-title")
            .textContent.toLowerCase();
        const cardLanguage = card
            .querySelector(".projectLanguage")
            .textContent.toLowerCase();
        if (
            cardTitle.includes(searchValue) ||
            cardLanguage.includes(searchValue)
        ) {
            card.style.display = "block";
        }
    }
}
searchBox.addEventListener("keyup", (e) => {
    SearchCard();
});
