<?php
include 'sesiune.php';
include 'header.php';
?>

<main class="main" style="margin-bottom:40px;">
    <div class="container">
        <h2 class="text-center" style="padding-top: 80px;">Tabelul ECHIPARI</h2>
    </div>
    <table class="table mt-5" style="border-bottom: 2px solid #DEE2E6">
        <thead>
            <tr>
                <th scope="col">Nr. crt.</th>
                <th scope="col">Model</th>
                <th scope="col">Nume Echipare </th>
                <th scope="col">Poza Echipare </th>
                <th scope="col">Pret (EUR)</th>
                <th scope="col">Acceleratie (s)</th>
                <th scope="col">Putere (kw)</th>
                <th scope="col">Viteza maxima (km/h)</th>
                <th scope="col">Tip motor</th>
                <th scope="col" class="text-center">Operații</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $interogare = "SELECT * 
            FROM echipare
            JOIN modele ON modele.id_model = echipare.id_model
            JOIN motorizare ON motorizare.cod_motor = echipare.cod_motor
            ORDER BY modele.nume_model ASC";
            $linii = mysqli_query($cnx, $interogare) or die("Eroare: " . mysqli_error($cnx));
            $i = 1; // $i este un contor care va fi incrementat în ciclul while
            while ($rez = mysqli_fetch_assoc($linii)):
                ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td class="w-70"><?= $rez['nume_model'] ?></td>
                    <td class="w-70"><?= $rez['nume_echipare'] ?></td>
                    <td class="w-70"><?= $rez['poza_model'] ?></td>
                    <td class="w-70"><?= number_format($rez['pret'], 2, ',', '.') ?></td>
                    <td class="w-70"><?= number_format($rez['acceleratie'], 1, ',', '.') ?></td>
                    <td class="w-70"><?= $rez['putere'] ?></td>
                    <td class="w-70"><?= $rez['viteza_max'] ?></td>
                    <td class="w-70"><?= $rez['tip_motor'] ?></td>
                    <td class="w-30 text-center">
                        <a href="modificEchipare.php?editez=<?= $rez['id_echipare'] ?>">
                            <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true" style="color: black;"></i></a>
                        <a href="formulare/stergEchipare.php?sterg=<?= $rez['id_echipare'] ?>">
                            <i class="fa fa-trash fa-lg" aria-hidden="true" style="color: black;"></i></a>
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

    <div class="container mt-5" style="width: 900px;">
        <form method="post" action="formulare/adaugEchipare.php" enctype="multipart/form-data">
            <div class="row">
                <!-- Coloana stângă -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <select class="form-select" name="id_model" id="id_model" method="POST">
                            <option value="0">Selectați Modelul</option>
                            <?php
                            $interogare = "SELECT * FROM modele ORDER BY nume_model ASC";
                            $selmodel = mysqli_query($cnx, $interogare) or die("Eroare: " . mysqli_error($cnx));
                            while ($rez = mysqli_fetch_assoc($selmodel)): ?>
                                <option value="<?= $rez['id_model'] ?>"><?= $rez['nume_model'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <!-- <label for="fotografie" class="form-label">Poza Echipare</label> -->
                        <input type="file" class="form-control" name="poza_model" id="poza_model"
                            placeholder="Poză Model (URL)">

                    </div>
                    <div class="mb-3">

                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="cod_motor" id="cod_motor">
                            <option value="0">Selectați Motorizarea</option>
                            <?php
                            $interogare = "SELECT * FROM motorizare ORDER BY tip_motor ASC";
                            $selmotor = mysqli_query($cnx, $interogare) or die("Eroare: " . mysqli_error($cnx));
                            while ($rez = mysqli_fetch_assoc($selmotor)): ?>
                                <option value="<?= $rez['cod_motor'] ?>"><?= $rez['tip_motor'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <input type="number" step="0.01" class="form-control" name="pret" id="pret"
                            placeholder="Pret (EUR)">
                    </div>
                </div>
                <!-- Coloana dreaptă -->
                <div class="col-md-6">
                    <div class="mb-4">
                        <input type="text" class="form-control" name="nume_echipare" id="nume_echipare"
                            placeholder="Nume Echipare">
                    </div>
                    <div class="mb-4">
                        <input type="number" step="0.01" class="form-control" name="acceleratie" id="acceleratie"
                            placeholder="Accelerație (0-100 km/h)">
                    </div>
                    <div class="mb-4">
                        <input type="number" class="form-control" name="viteza_max" id="viteza_max"
                            placeholder="Viteza Maximă (km/h)">
                    </div>
                    <div class="mb-5">
                        <input type="number" class="form-control" name="putere" id="putere" placeholder="Putere (kW)">
                    </div>
                </div>
            </div>
            <!-- Funcția - centrată sub coloane -->
            <!-- Butonul centrat -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="button secondary-button">Adaugă!</button>
            </div>
        </form>
    </div>
    </form>
</main>

<?php
include 'footer-admin.php';
?>