<?php
session_start();
print_r($_POST);

function corectez($sir)
{
    global $cnx;
    $sir = trim($sir);
    $sir = stripslashes($sir);
    $sir = htmlspecialchars($sir);
    $sir = mysqli_real_escape_string($cnx, $sir);
    return $sir;
}

$poza = $_FILES["poza_model"]["name"];
$nmtmp = $_FILES["poza_model"]["tmp_name"];
$extensie = pathinfo($poza, PATHINFO_EXTENSION);

$pinit = 'temp.png';


if (isset($_SESSION['logat']) && $_SESSION['logat'] === true) {
    $eroare = '';

    if (empty($_POST['id_model'])) {
        $eroare .= '<p>Nu ați introdus modelul!</p>';
    }

    if (empty($_POST['nume_echipare'])) {
        $eroare .= '<p>Nu ați introdus numele echipării!</p>';
    }

    if (empty($_POST['pret'])) {
        $eroare .= '<p>Nu ați introdus prețul!</p>';
    }

    if (empty($_POST['acceleratie'])) {
        $eroare .= '<p>Nu ați introdus accelerația!</p>';
    }

    if (empty($_POST['putere'])) {
        $eroare .= '<p>Nu ați introdus puterea!</p>';
    }

    if (empty($_POST['viteza_max'])) {
        $eroare .= '<p>Nu ați introdus viteza maximă!</p>';
    }

    if (empty($_POST['cod_motor'])) {
        $eroare .= '<p>Nu ați introdus codul motorului!</p>';
    }

    if ($eroare == '') {
        include '../../conectare.php';

        $model = corectez($_POST['id_model']);
        $echipare = corectez($_POST['nume_echipare']);
        $pret = corectez($_POST['pret']);
        $acceleratie = corectez($_POST['acceleratie']);
        $putere = corectez($_POST['putere']);
        $viteza_max = corectez($_POST['viteza_max']);
        $cod_motor = corectez($_POST['cod_motor']);

        $interogare_nume_model = "SELECT nume_model FROM modele WHERE id_model = $model";
        $result = mysqli_query($cnx, $interogare_nume_model) or die("Eroare: " . mysqli_error($cnx));

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nume_model = $row['nume_model'];
        } else {
            $nume_model = null; // sau un mesaj de eroare, după cum dorești
        }

        $comanda = "INSERT INTO echipare (id_model, poza_model, nume_echipare, pret, acceleratie, putere, viteza_max, cod_motor) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stm = mysqli_prepare($cnx, $comanda);
        mysqli_stmt_bind_param($stm, 'issddiis', $model, $poza, $echipare, $pret, $acceleratie, $putere, $viteza_max, $cod_motor);
        mysqli_stmt_execute($stm);

        $nr = mysqli_insert_id($cnx);

        $poza_r = $nume_model . "-" . $echipare . "_" . $nr . "." . strtolower($extensie);
        $cale = "../../pics/echipare/$poza_r";
        $rezultat = move_uploaded_file($nmtmp, $cale);
        $cdamodif = "UPDATE echipare set poza_model='$poza_r' where id_echipare=$nr";

        mysqli_query($cnx, $cdamodif) or die("Nu merge update in tabel");

        mysqli_close($cnx); //sau $cnx = null;
        header('Location: ../echipare.php');
    } else {
        echo "Eroare: " . $eroare;
    }
} else {
    // Nu este logat!
    header('Location: ../administrare.php');
}
?>
<!-- End -->