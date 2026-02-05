<?php
include 'sesiune.php';
include 'header.php';
?>

<main id="main">
    <div class="container">
        <h2 class="text-center" style="padding-top: 120px;">Tabelul MOTOARE</h2>
    </div>

    <div class="container" style="width: 500px;">
        <table class="table mt-5" style="border-bottom: 2px solid #DEE2E6">
            <thead>
                <tr>
                    <th scope="col">Nr. crt.</th>
                    <th scope="col">Tip Motor</th>
                    <th scope="col" class="text-center">Operații</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $interogare = "SELECT * FROM motorizare ORDER BY tip_motor ASC";
                $linii = mysqli_query($cnx, $interogare) or die("Eroare: " . mysqli_error($cnx));
                $i = 1; // $i este un contor care va fi incrementat în ciclul while
                while ($rez = mysqli_fetch_assoc($linii)):
                ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td class="w-70"><?= $rez['tip_motor'] ?></td>
                        <td class="w-30 text-center">
                            <a href="modificMotor.php?editez=<?= $rez['cod_motor'] ?>">
                                <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                            <a href="formulare/stergMotor.php?sterg=<?= $rez['cod_motor'] ?>">
                                <i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php
                    $i++;
                endwhile;
                // mysqli_close($cnx);
                ?>
            </tbody>
        </table>
    </div>

    <?php
    $editez = $_GET["editez"];
    $caut = "SELECT * FROM motorizare where cod_motor = $editez";
    $rezultat = mysqli_query($cnx, $caut);
    $rez = mysqli_fetch_assoc($rezultat);
    ?>
    <div class="container mt-5" style="width: 500px;">
        <form method="post" action="formulare/editMotor.php">
            <input type="hidden" name="editez" value="<?= $editez ?>">
            <div class="form-group mb-5">
                <label for="functia">Tip Motor:</label>
                <input class="form-control" id="tio_motor" name="tip_motor" type="text" value="<?= $rez['tip_motor'] ?>">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="button secondary-button">Modifică</button>
            </div>
</main>
<?php
include 'footer-admin.php';
?>

</html>