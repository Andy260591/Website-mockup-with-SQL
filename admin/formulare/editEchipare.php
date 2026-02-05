<?php
session_start();

if (isset($_SESSION['logat']) && $_SESSION['logat'] === true) {
    include '../../conectare.php';

    // Sanitize inputs
    $id_echipare = (int) $_POST['editez'];
    $model = (int) $_POST['id_model'];
    $echipare = trim($_POST['nume_echipare']);
    $pret = (float) $_POST['pret'];
    $acceleratie = (float) $_POST['acceleratie'];
    $putere = (int) $_POST['putere'];
    $viteza_max = (int) $_POST['viteza_max'];
    $cod_motor = (int) $_POST['cod_motor'];


    // Handle image upload
    $poza = '';
    if (isset($_FILES['poza_model']) && $_FILES['poza_model']['error'] === UPLOAD_ERR_OK) {

        $fileTmpPath = $_FILES['poza_model']['tmp_name'];
        $fileName = basename($_FILES['poza_model']['name']);
        $extensie = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $interogare_nume_model = "SELECT nume_model FROM modele WHERE id_model = $model";
        $result = mysqli_query($cnx, $interogare_nume_model) or die("Eroare: " . mysqli_error($cnx));


        $nume_model = '';
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nume_model = $row['nume_model'];
        }

        $poza_r = $nume_model . "-" . $echipare . "_" . $id_echipare . "." . strtolower($extensie);

        $cale = "../../pics/echipare/$poza_r";


        if (move_uploaded_file($fileTmpPath, $cale)) {
            $poza = $poza_r;
        } else {
            echo "Eroare la mutarea fișierului.";
            exit;
        }
    } else {
        // If no file uploaded, keep the existing one from DB
        $query = "SELECT poza_model FROM echipare WHERE id_echipare = ?";
        $stmt = mysqli_prepare($cnx, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id_echipare);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $poza);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Update query
    $query = "UPDATE echipare 
              SET id_model = ?, poza_model = ?, nume_echipare = ?, pret = ?, acceleratie = ?, putere = ?, viteza_max = ?, cod_motor = ?
              WHERE id_echipare = ?";

    $stmt = mysqli_prepare($cnx, $query);
    mysqli_stmt_bind_param($stmt, 'issddiiii', $model, $poza, $echipare, $pret, $acceleratie, $putere, $viteza_max, $cod_motor, $id_echipare);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($cnx);

    header('Location: ../echipare.php');
    exit;
} else {
    header('Location: ../administrare.php');
    exit;
}
