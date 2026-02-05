<?php
include 'sesiune.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Porsche</title>
    <link rel="icon" href="../pics/porsche-icon.webp" />
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/modele.css" />
    <link rel="stylesheet" href="../css/general.css" />
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/administrare.css">

    <link rel="shortcut icon" href="../pics/favicon/favicon.png" type="image/x-icon">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <!-- Header part -->
    <section>
        <header class="header-section-modele">
            <div class="left-section">
                <div class="left-section-container">
                    <div class="meniu-icon-container">
                        <img class="meniu-icon-modele" src="../pics/meniu/menu-lines.svg" alt="meniu" />
                    </div>
                    <a href="../index.php">Home</a>
                </div>
            </div>
            <div class="center-section-modele">
                <p>Porsche</p>
            </div>
            <div class="right-section-modele">
                <a href="administrare.php" class="login-container-modele">
                    <img src="../pics/meniu/login.svg" alt="Login">
                    <p><?= $nume ?></p>
                </a>
            </div>
        </header>
    </section>

    <!-- End of Header -->
    <main class="main-body-modele">

        <nav class="<?= $display_meniu ?> nav">
            <a class="nav-link active" aria-current="page" href="administrare.php">Acasa</a>
            <a class="nav-link" href="echipare.php">Echipari</a>
            <a class="nav-link" href="motoare.php">Motoare</a>
        </nav>

        <div>
            <div class="main-container">
                <h2>ADMIN - Porsche</h2>
                <p>Aplicație web destinată gestionării bazei de date a site-ului <b>Porsche</b>.</p>
                <div class="<?= $display_btcon ?>">
                    <a href="logare.php" class="login-button">Conectare</a>
                </div>
                <div class="<?= $display_btdecon ?>">
                    <a href="delogare.php" class="login-button">Deconectare</a>
                </div>
            </div>
        </div>
    </main>

    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

    <script src="../js/filter.js"></script>
</body>
<?php
// include 'footer-admin.php';
?>

</html>