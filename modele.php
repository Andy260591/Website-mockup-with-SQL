<?php include 'conectare.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Porsche</title>
    <link rel="icon" href="/pics/porsche-icon.webp" />
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/modele.css" />
    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/footer.css">

    <link rel="shortcut icon" href="pics/favicon/favicon.png" type="image/x-icon">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <!-- Header part -->
    <section>
        <header class="header-section-modele">
            <div class="left-section">
                <div class="left-section-container">
                    <div class="meniu-icon-container">
                        <img class="meniu-icon-modele" src="pics/meniu/menu-lines.svg" alt="meniu" />
                    </div>
                    <a href="index.php">Home</a>
                </div>
            </div>
            <div class="center-section-modele">
                <p>Porsche</p>
            </div>
            <div class="right-section">
                <a href="admin/administrare.php" class="login-container">
                    <img style="filter: none;" src="pics/meniu/login.svg" alt="Login">

                </a>
        </header>
    </section>

    <!-- End of Header -->
    <main class="main-body-modele bg-light">
        <h1 class="model-overview">Model overview</h1>
        <section class="filter-container">
            <?php
            $totalCountQuery = "SELECT COUNT(*) AS total FROM echipare";
            $totalResult = mysqli_query($cnx, $totalCountQuery);
            $totalRow = mysqli_fetch_assoc($totalResult);
            $totalCount = $totalRow['total'];
            ?>

            <aside class="model-filter">
                <!-- Control buttons -->
                <div id="myBtnContainer">
                    <button class="btn" data-model="all" onclick="filterSelection('all')">Show all
                        (<?= $totalCount ?>)</button>

                    <?php
                    $filtru = "SELECT modele.nume_model, COUNT(echipare.id_echipare) AS count
                    FROM modele
                    LEFT JOIN echipare ON modele.id_model = echipare.id_model
                    GROUP BY modele.nume_model
                    ORDER BY modele.nume_model ASC";

                    $filtrucom = mysqli_query($cnx, $filtru) or die("Eroare: " . mysqli_error($cnx));

                    while ($rezpro = mysqli_fetch_assoc($filtrucom)):
                        $modelName = $rezpro['nume_model'];
                        ?>

                        <button class="btn" data-model="<?= $modelName ?>"
                            onclick="filterSelection('<?= $rezpro['nume_model'] ?>')">
                            <?= $rezpro['nume_model'] ?> (<?= $rezpro['count'] ?>)</button>

                    <?php endwhile; ?>
                </div>
                <!-- END of Control buttons -->

            </aside>

            <!-- Cards -->
            <?php
            $echipare = "SELECT nume_model, poza_model, nume_echipare, pret, acceleratie, putere, viteza_max, tip_motor 
            FROM modele, echipare, motorizare 
            WHERE modele.id_model = echipare.id_model 
            AND echipare.cod_motor = motorizare.cod_motor 
            ORDER BY nume_model";

            $echiparecom = mysqli_query($cnx, $echipare) or die("Eroare: " . mysqli_error($cnx));

            $current_model = null;
            ?>

            <div class="all-models-wrapper">
                <?php while ($rezpro = mysqli_fetch_assoc($echiparecom)): ?>
                    <?php
                    if ($current_model !== $rezpro['nume_model']) {
                        if ($current_model !== null) {
                            echo '</div>'; // close previous .model-grid
                        }

                        $current_model = $rezpro['nume_model'];
                        $modelClass = preg_replace('/\s+/', '', $current_model); // sanitize for class
                
                        echo "<h2 id='{$modelClass}' class='model_header filterDiv {$modelClass}'>All {$current_model} Models</h2>";
                        echo "<div class='model-grid filterDiv {$modelClass}'>";
                    }
                    ?>

                    <div class="card-model bg-white filterDiv <?= $rezpro['nume_model'] ?>">
                        <p><?= $rezpro['tip_motor'] ?></p>
                        <img src="pics/echipare/<?= $rezpro['poza_model'] ?>" alt="">
                        <h3 style="height: 100px;"><?= $rezpro['nume_model'] . " " . $rezpro['nume_echipare'] ?></h3>
                        <p class="desc">de la <b><?= number_format($rezpro['pret'], 2, ',', '.') ?>
                                EUR</b> Pretul include
                            TVA</p>
                        <p class="specs"><?= number_format($rezpro['acceleratie'], 1, ',', '.') ?> s</p>
                        <p class="desc">Acceleratie 0-100 km/h</p>
                        <p class="specs"><?= $rezpro['putere'] ?> kW / <?= round($rezpro['putere'] * 1.36) ?> CP</p>
                        <p class="desc">Putere (kW) / Putere (CP)</p>
                        <p class="specs"><?= $rezpro['viteza_max'] ?> km/h</p>
                        <p class="desc">Viteza maxima</p>
                        <button class="secondary-button button"
                            onclick="window.open('https://configurator.porsche.com/ro-RO/model-start/<?= strtolower($rezpro['nume_model']) ?>')">Select
                            model</button>
                    </div>

                <?php endwhile; ?>

                <?php if ($current_model !== null)
                    echo '</div>'; ?>
            </div>
            <!-- End of Cards -->


    </main>
    <?php
    include 'admin/footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

    <script src="js/filter.js"></script>
</body>

</html>