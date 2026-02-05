<?php
session_start();
print_r($_POST);
function corectez($sir)
{
    $sir = trim($sir);
    $sir = stripslashes($sir);
    $sir = htmlspecialchars($sir);
    return $sir;
}

if (isset($_SESSION['logat']) && $_SESSION['logat'] == true) {
    $eroare = '';
    if (empty($_POST['tip_motor'])) {
        $eroare .= '<p>Nu ați introdus tipul de motor!</p>';
    } else {
        $motor = corectez($_POST['tip_motor']);
    }

    if ($eroare == '') {
        // Nu sunt mesaje de eroare
        include '../../conectare.php';
        // formulez comanda INSERT
        $comanda = "INSERT INTO motorizare (tip_motor) VALUES (?)";
        if ($stm = mysqli_prepare($cnx, $comanda)) {
            mysqli_stmt_bind_param($stm, 's', $motor);
            mysqli_stmt_execute($stm);
        } else {
            echo "Eroare la crearea variabilei de tip statement.";
        }
        mysqli_close($cnx);
        // Reincarc "functii.php"
        header('Location: ../motoare.php');
    } else {
        echo "Eroare: " . $eroare;
    }
} else {
    // Nu este logat!
    header('Location: ../administrare.php');
}
