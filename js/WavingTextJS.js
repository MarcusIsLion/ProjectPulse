const h1 = document.querySelector("#waveText");
const text = h1.textContent;
let animationInProgress = false;
h1.innerHTML = ""; // On vide le texte de la balise <h1>

for (let i = 0; i < text.length; i++) {
    const span = document.createElement("span");
    span.textContent = text[i];
    span.style.transitionDelay = `${i * 50}ms`; // Ajout d'un délai pour chaque lettre
    h1.appendChild(span);
}

function startAnimation() {
    if (animationInProgress) return; // Empêche l'animation si elle est déjà en cours ou bloquée

    const spans = h1.querySelectorAll("span");
    spans.forEach((span, index) => {
        span.classList.add("hovered");
        span.style.animation = `waveEffect 0.5s ease ${index * 0.05}s`;
    });

    // Empêche de rejouer l'animation pendant 5 secondes
    animationInProgress = true;

    // Réinitialiser après 1 seconde (durée de l'animation max)
    setTimeout(() => {
        spans.forEach((span) => {
            span.style.animation = ""; // Réinitialisation de l'animation
        });
    }, 1000);

    // Réautorise l'animation après 5 secondes
    setTimeout(() => {
        animationInProgress = false;
    }, 1100);
}
startAnimation();
setInterval(startAnimation, 6000); // Start the animation every 6 seconds
