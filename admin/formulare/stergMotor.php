<?php
session_start();

if (isset($_SESSION['logat']) && $_SESSION['logat'] == true) {
    $cod = $_GET['sterg'];
    include '../../conectare.php';
    $comanda = "DELETE FROM motorizare WHERE cod_motor = $cod";
    if (!mysqli_query($cnx, $comanda)) {
        echo "Eroare la ștergere: " . mysqli_error($cnx);
    }

    mysqli_close($cnx);
    // Reincarc "functii.php"
    header('Location: ../motoare.php');
} else {
    // Nu este logat!
    header('Location: ../administrare.php');
}
?>
<!-- test -->