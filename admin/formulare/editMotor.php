<?php
session_start();
if (isset($_SESSION['logat']) && $_SESSION['logat'] == true) {
    $cod = $_POST['editez'];
    $corecta = $_POST['tip_motor'];
    include '../../conectare.php';
    $comanda = "UPDATE motorizare SET tip_motor = ? WHERE cod_motor = ?";
    $stm = mysqli_prepare($cnx, $comanda);
    mysqli_stmt_bind_param($stm, 'si', $corecta, $cod);
    mysqli_stmt_execute($stm);
    mysqli_close($cnx);
    // Reincarc "functii.php"
    header('Location: ../motoare.php');
} else {
    // Nu este logat!
    header('Location: ../administrare.php');
}
