<!-- Cards -->
<div class="model-container">

    <?php
    $echipare = "SELECT nume_model, poza_model, nume_echipare, pret, acceleratie, putere, viteza_max, tip_motor 
                    FROM modele, echipare, motorizare 
                    WHERE modele.id_model=echipare.id_model 
                    AND echipare.cod_motor = motorizare.cod_motor
                    ORDER BY nume_model";

    $echiparecom = mysqli_query($cnx, $echipare) or die("Eroare: " . mysqli_error($cnx));

    $current_model = null;

    while ($rezpro = mysqli_fetch_assoc($echiparecom)):
        if ($current_model !== $rezpro['nume_model']):
            $current_model = $rezpro['nume_model'];
            ?>

            <h2 class="model_header filterDiv <?= $rezpro['nume_model'] ?>">All <?= $current_model ?> Models</h2>

            <?php
        endif;
        ?>

        <div class="card-model filterDiv <?= $rezpro['nume_model'] ?>">
            <p><?= $rezpro['tip_motor'] ?></p>
            <img src="pics/echipare/<?= $rezpro['poza_model'] ?>" alt="">
            <h3><?= $rezpro['nume_model'] . " " . $rezpro['nume_echipare'] ?></h3>
            <p class="desc">de la <b><?= number_format($rezpro['pret'], 2, ',', '.') ?> EUR</b> Pretul include
                TVA</p>
            <p class="specs"><?= number_format($rezpro['acceleratie'], 1, ',', '.') ?> s</p>
            <p class="desc">Acceleratie 0-100 km/h</p>
            <p class="specs"> <?= $rezpro['putere'] ?> kW / <?= round($rezpro['putere'] * 1.36) ?> CP</p>
            <p class="desc">Putere (kW) / Putere (CP)</p>
            <p class="specs"><?= $rezpro['viteza_max'] ?> km/h</p>
            <p class="desc">Viteza maxima</p>
            <button class="secondary-button button"
                onclick="window.open('https://configurator.porsche.com/ro-RO/model-start/')"> Select
                model</button>
        </div>
    <?php endwhile; ?>
</div>
<!-- End of Cards -->