<?php require_once __DIR__ . '/includes/session.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index.php</title>
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5ef442696c.js" crossorigin="anonymous"></script>
</head>
<body>


<?php include("./includes/init.php"); ?>



<!-- HEADER -->


    <?php include("./includes/parts/header.php"); ?>



<!-- MAIN -->


    <main class="wrapper small-margin">
        <h1 class="h1-index">CHATEAU CIEL<span>Vente de Châteaux Gonflables en Belgique</span></h1>


        <section class="services-container">

            <div class="service-gauche">

                    <a href="./achat.php">
                        <img src="assets/img/achatgonflable.png">
                    </a>

                    <a href="./achat.php" class="button-style">
                        BOUTIQUE
                    </a>


            </div>
        </section>







        <?php

        $sql = "SELECT 
                    produits.id,
                    produits.nom,
                    produits.image,
                    produits.prix,
                    gammes.nom AS gamme_nom
                FROM produits
                JOIN gammes ON produits.gamme_id = gammes.id
                WHERE gammes.id = 1
                ";
        $rslt = mysqli_query($conn, $sql);

        $first = true;
        $page_retour = 'index.php';

        while ($produit = mysqli_fetch_assoc($rslt)) {

        if ($first === true){
            echo '<section>';
            echo '<h2 class="h2-index">LA GAMME ' . e($produit["gamme_nom"]) . '</h2>';
            echo '<div class="general-p">';
            $first = false;
        }

        include("./includes/parts/box_product.php");
        }

        echo '</div>';
        echo '</section>';
        ?>






        <?php

        
        $sql = "SELECT 
                    produits.id,
                    produits.nom,
                    produits.image,
                    produits.prix,
                    gammes.nom AS gamme_nom
                FROM produits
                JOIN gammes ON produits.gamme_id = gammes.id
                WHERE gammes.id = 2
                ";


        $rslt = mysqli_query($conn, $sql);

        $first = true;

        while ($produit = mysqli_fetch_assoc($rslt)) {

        if ($first === true){
            echo '<section>';
            echo '<h2 class="h2-index">LA GAMME ' . e($produit["gamme_nom"]) . '</h2>';
            echo '<div class="general-p">';
            $first = false;
        }

        include("./includes/parts/box_product.php");
        }

        echo '</div>';
        echo '</section>';
        ?>


        
        

        <section class="button-cta-container">
            <a href="./achat.php" class="button-cta-item">
            VOIR PRODUITS
            </a>
        </section>



    </main>


<!-- FOOTER -->


    <?php include("./includes/parts/footer.php"); ?>

</body>
</html>
