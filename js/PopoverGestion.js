///<sumary>
/// Script for the popover management
///</sumary>
///<param name="$buttonid">The id of the button to display the popover</param>
function afficherPopover($buttonid) {
    // j'affiche le popover avec un toggle
    $buttonid.classList.toggle("hidden");
    setTimeout(() => {
        $buttonid.classList.toggle("hidden");
    }, 2000);
}
