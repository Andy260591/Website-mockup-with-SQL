<?php
include 'conectare.php';
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
  <link rel="stylesheet" href="css/general.css" />
  <link rel="stylesheet" href="css/footer.css">

  <link rel="shortcut icon" href="pics/favicon/favicon.png" type="image/x-icon">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
  <!-- Header part -->
  <section id="home">
    <header class="header-section">
      <div class="left-section">
        <div class="left-section-container">
          <div class="meniu-icon-container">
            <img class="meniu-icon" src="pics/meniu/menu-lines.svg" alt="meniu" />
          </div>
          <a href="#home">Home</a>
        </div>
      </div>
      <div class="center-section">
        <p>Porsche</p>
      </div>
      <div class="right-section">
        <a href="admin/administrare.php" class="login-container">
          <img src="pics/meniu/login.svg" alt="Login">
        </a>
    </header>
  </section>
  <!-- End of Header -->

  <main class="main-body">

    <!-- Video part -->
    <div class="video-section">
      <div class="video-container">
        <video class="video-hero" autoplay muted loop src="vids/promo.mp4" type="video/mp4"></video>
        <div class="discover-more">
          <h1>The record-breaking Taycan.</h1>
          <a href="https://www.porsche.com/stories/mobility/beyond-limits-the-record-breaking-taycan/"
            target="_blank"><button>Discover more</button></a>
        </div>
        <div class="bottom-shadow"></div>
      </div>
    </div>
    <!-- End of video -->

    <section class="main-content">

      <!-- Article part -->
      <section class="article-flex-container">
        <div class="article-preview">
          <a href="https://www.porsche.com/central-eastern-europe/en/_romania_/models/911/carrera-models/911-carrera-t/"
            target="_blank">
            <img class="article-pic" src="pics/articol1.avif" alt="" />
            <div class="bottom-article-shadow"></div>
            <div class="article-text-container">
              <div class="article-text">
                <p>The new 911 Carrera T.</p>
              </div>
              <div class="article-arrow">
                <img src="pics/right-arrow.svg" alt="" />
              </div>
            </div>
          </a>
        </div>

        <div class="article-preview">
          <a href="https://racing.porsche.com/articles/fe-miami-imsa-long-beach-race-report" target="_blank">
            <img class="article-pic" src="pics/articol2.avif" alt="" />
            <div class="bottom-article-shadow"></div>
            <div class="article-text-container">
              <div class="article-text">
                <p>Porsche teams take on the US.</p>
              </div>
              <div class="article-arrow">
                <img src="pics/right-arrow.svg" alt="" />
              </div>
            </div>
          </a>
        </div>

        <div class="article-preview">
          <a href="https://www.porsche.com/central-eastern-europe/en/_romania_/models/macan/macan-electric-models/macan-turbo-electric/"
            target="_blank">
            <img class="article-pic" src="pics/articol3.avif" alt="" />
            <div class="bottom-article-shadow"></div>
            <div class="article-text-container">
              <div class="article-text">
                <p>The Macan Turbo.</p>
              </div>
              <div class="article-arrow">
                <img src="pics/right-arrow.svg" alt="" />
              </div>
            </div>
          </a>
        </div>
      </section>
      <!-- End of articles -->

      <!-- Models part -->
      <section>
        <h1 class="modele">Modele</h1>
        <div>
          <div class="model-grid-container">
            <?php
            $modele = "SELECT 
            modele.id_model,
            modele.nume_model, 
            modele.nume_foto, 
            modele.fotografie, 
            modele.descriere,
            MIN(echipare.pret) AS pret_minim
            FROM modele
            LEFT JOIN echipare ON modele.id_model = echipare.id_model
            GROUP BY modele.id_model, modele.nume_model, modele.nume_foto, modele.fotografie, modele.descriere
            ORDER BY modele.nume_model ASC";

            $modelecom = mysqli_query($cnx, $modele) or die("Eroare: " . mysqli_error($cnx));

            while ($rezpro = mysqli_fetch_assoc($modelecom)):
              $id_model_curent = $rezpro['id_model'];

              // tip_motor for every model 
              $motoare = "SELECT DISTINCT motorizare.tip_motor
                FROM echipare
                JOIN motorizare ON echipare.cod_motor = motorizare.cod_motor
                WHERE echipare.id_model = $id_model_curent
                ORDER BY motorizare.tip_motor ASC";

              $motoarecom = mysqli_query($cnx, $motoare) or die("Eroare: " . mysqli_error($cnx));
              ?>

              <!-- Begining of model -->
              <div class="model-card">
                <div class="model-pic-container">
                  <img class="model-pic" src="pics/modele/<?= $rezpro['fotografie'] ?>" alt="" />
                  <div class="upper-model-shadow"></div>
                  <div class="bottom-model-shadow"></div>
                </div>
                <div class="model-info">
                  <div class="upper-model-info">
                    <img class="model-name" src="pics/modele/<?= $rezpro['nume_foto'] ?>" alt="" />
                    <?php while ($rezmot = mysqli_fetch_assoc($motoarecom)): ?>
                      <p><?= $rezmot['tip_motor'] ?></p>
                    <?php endwhile; ?>
                  </div>
                  <div class="lower-model-info">
                    <h2><?= $rezpro['descriere'] ?></h2>
                    <p>
                      de la <?= number_format($rezpro['pret_minim'], 2, ',', '.') ?> EUR Prețul include TVA
                    </p>
                    <button class="button primary-button"
                      onclick="window.open('https://configurator.porsche.com/ro-RO/model-start/<?= strtolower($rezpro['nume_model']) ?>')">
                      Configure your <?= $rezpro['nume_model'] ?>
                    </button>
                    <a href="modele.php#<?= $rezpro['nume_model'] ?>">
                      <button class="button secondary-button">
                        All <?= $rezpro['nume_model'] ?> models
                      </button>
                    </a>
                  </div>
                </div>
              </div>
              <!-- End of model -->
            <?php endwhile; ?>

          </div>
        </div>
      </section>

    </section>
    <!-- Find more part -->
    <section class="find-more">
      <div class="find-more-card">
        <div class="find-more-pic">
          <img src="pics/discover.avif" alt="" />
        </div>

        <div class="find-more-text">
          <h2>Find your new or pre-owned Porsche.</h2>
          <p>
            A Porsche is as individual as its owner. It is always an
            expression of one’s own personality. We help you find your
            personal dream vehicle from authorised Porsche Centres.
          </p>
          <button class="button primary-button">Find your Porsche</button>
        </div>
      </div>
    </section>
    <!-- End of find more -->

    <section class="main-content">

      <!-- Discover part -->
      <h2 class="modele">Discover</h2>
      <section class="discover-flex-container">
        <div class="article-preview">
          <a href="https://www.porsche.com/central-eastern-europe/en/_romania_/aboutporsche/e-performance/"
            target="_blank">
            <img class="article-pic" src="pics/articol4.avif" alt="" />
            <div class="bottom-article-shadow"></div>
            <div class="article-text-container">
              <div class="article-text">
                <p>E-Performance - Sustainable Mobility</p>
              </div>
              <div class="article-arrow">
                <img src="pics/right-arrow.svg" alt="" />
              </div>
            </div>
          </a>
        </div>

        <div class="article-preview">
          <a href="https://www.porsche.com/central-eastern-europe/en/_romania_/accessoriesandservice/tequipment/"
            target="_blank">
            <img class="article-pic" src="pics/articol5.avif" alt="" />
            <div class="bottom-article-shadow"></div>
            <div class="article-text-container">
              <div class="article-text">
                <p>Porsche Tequipment</p>
              </div>
              <div class="article-arrow">
                <img src="pics/right-arrow.svg" alt="" />
              </div>
            </div>
          </a>
        </div>

        <div class="article-preview">
          <a href="https://www.porsche.com/central-eastern-europe/en/_romania_/accessoriesandservice/exclusive-manufaktur/passion/"
            target="_blank">
            <img class="article-pic" src="pics/articol6.avif" alt="" />
            <div class="bottom-article-shadow"></div>
            <div class="article-text-container">
              <div class="article-text">
                <p>Porsche Exclusive Manufaktur</p>
              </div>
              <div class="article-arrow">
                <img src="pics/right-arrow.svg" alt="" />
              </div>
            </div>
          </a>
        </div>
      </section>
      <!-- End of Discover -->



  </main>
  <?php
  include 'admin/footer.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
</body>

</html>