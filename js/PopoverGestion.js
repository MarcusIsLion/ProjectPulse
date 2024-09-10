///<sumary>
/// Script for the popover management
///</sumary>
///<param name="$buttonid">The id of the button to display the popover</param>
function afficherPopover($buttonid) {
    var div = document.getElementById($buttonid);
    div.classList.toggle("hidden");
    setTimeout(() => {
        div.classList.toggle("hidden");
    }, 2000);
}
