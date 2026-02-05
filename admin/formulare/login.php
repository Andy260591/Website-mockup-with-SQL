<?php
session_start();
function corectez($sir)
{
    $sir = trim($sir);
    $sir = stripslashes($sir);
    $sir = htmlspecialchars($sir);
    return $sir;
}

// preiau valorile din campurile formularului (nume și parola)

$eroare = '';

if (empty($_POST['nume'])) {
    $eroare .= '<p>Nu ați introdus numele!</p>';
} else {
    $nume = corectez($_POST['nume']);
}
if (empty($_POST['parola'])) {
    $eroare .= '<p>Nu ați introdus parola!</p>';
} else {
    $parola = corectez($_POST['parola']);
}

// Verific daca preluarea datelor s-a derulat corect
if ($eroare == '') {
    // Nu sunt mesaje de eroare
    include '../../conectare.php';
    $comanda = "SELECT * FROM admin where nume = ? and parola = ?";
    if ($stm = mysqli_prepare($cnx, $comanda)) {
        mysqli_stmt_bind_param($stm, 'ss', $nume, $parola);
        mysqli_stmt_execute($stm);
        $rez = mysqli_stmt_get_result($stm); // obtin multimea de selectie
        if ($linie = mysqli_fetch_assoc($rez)) {
            $_SESSION['logat'] = true;
            $_SESSION['nume'] = $linie['nume'];
        }
        mysqli_free_result($rez);
    }
    mysqli_close($cnx);
    // Reincarc "index.php"
    header('Location: ../administrare.php');
} else {
    echo "Eroare: " . $eroare;
}
