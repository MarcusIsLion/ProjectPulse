// This script is used to manage the waving text effect on the home page

const h1 = document.querySelector("#waveText"); // Get the first element with the id "waveText"
const text = h1.textContent; // Get the text content of the element
let animationInProgress = false; // Variable to check if the animation is in progress
h1.innerHTML = ""; // Empty the element

// Manage span for each letter of the text
for (let i = 0; i < text.length; i++) {
    const span = document.createElement("span");
    span.textContent = text[i];
    span.style.transitionDelay = `${i * 50}ms`; // Adding a delay to the transition
    h1.appendChild(span);
}

///<summary>
/// Function that starts the animation
///</summary>
function startAnimation() {
    if (animationInProgress) return; // If the animation is in progress, return

    const spans = h1.querySelectorAll("span");
    spans.forEach((span, index) => {
        span.classList.add("hovered");
        span.style.animation = `waveEffect 0.5s ease ${index * 0.05}s`;
    });

    // Block the animation for the duration of the animation
    animationInProgress = true;

    // Reset the animation after 1 second
    setTimeout(() => {
        spans.forEach((span) => {
            span.style.animation = ""; // Reset the animation
        });
    }, 1000);

    // Allow the animation to be launched again after 1.1 seconds
    setTimeout(() => {
        animationInProgress = false;
    }, 1100);
}
startAnimation();
setInterval(startAnimation, 6000); // Start the animation every 6 seconds
