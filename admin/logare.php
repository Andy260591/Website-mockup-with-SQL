<?php
// include 'sesiune.php';
$home_active = ' class="active"';
include 'administrare.php';
?>

<main id="main">
    <div class="container" style="padding-top: 50px;">
        <div class="section-title col-12">
            <h2>Conectare la baza de date</h2>
        </div>

        <div class="form">
            <form action="formulare/login.php" method="post">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input type="text" name="nume" class="form-control" id="nume" placeholder="Numele">
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="password" class="form-control" name="parola" id="parola" placeholder="Parola">
                    </div>
                </div>
                <div class="text-center"><button type="submit" class="button secondary-button">Login</button></div>
            </form>
        </div>
    </div>
</main><!-- End #main -->
</body>

</html>