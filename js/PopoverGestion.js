function afficherPopover($buttonid) {
    // j'affiche le popover avec un toggle
    $buttonid.classList.toggle("hidden");
    setTimeout(() => {
        $buttonid.classList.toggle("hidden");
    }, 2000);
}
