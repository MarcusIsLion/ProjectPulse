<?php
function generateAlertBox($message, $type, $link)
{
    $alertBox = '<div class="alertbox ' . $type . '">';
    $alertBox .= '<p>' . $message . '</p>';
    $alertBox .= '<a href="' . $link . '" class="button GeneralButton"><i class="fa-solid fa-close"></i></a>';
    $alertBox .= '</div>';

    echo $alertBox;
}
