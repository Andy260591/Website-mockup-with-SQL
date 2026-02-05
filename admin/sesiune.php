<?php
session_start();

if (isset($_SESSION['logat']) && $_SESSION['logat'] == true) {
    $nume = $_SESSION['nume'];
    $display_btcon = "d-none"; // Butonul Conectare nu va fi vizibil
    $display_btdecon = "d-block"; // Butonul Deonectare va fi vizibil
    $display_meniu = "shown";
} else {
    $nume = 'Nelogat';
    $display_btcon = "d-block"; // Butonul Conectare va fi vizibil
    $display_btdecon = "d-none"; // Butonul Deonectare nu va fi vizibil
    $display_meniu = "visually-hidden";
}

include '../conectare.php';

?>
<!-- Final -->