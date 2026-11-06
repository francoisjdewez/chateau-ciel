<?php require_once __DIR__ . '/includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>achat.php</title>
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
    <?php include("./includes/parts/header.php"); ?>


    <main class="wrapper small-margin">

    <h1 class="h1-index">NOS PRODUITS</h1>


    <section class="product-main">

        <div>
            <h2>CATEGORIES</h2>
                <h3>TRANCHES DE PRIXS</h3>
                    <ul class="categorie-list">
                        <a href="./achat.php" class="categorie-lien"><li>entrée de gamme(200-400€)</li></a>
                        <a href="./achat.php" class="categorie-lien"><li>moyenne gamme(400-1000€)</li></a>
                        <a href="./achat.php" class="categorie-lien"><li>haute gamme(1000-2000€+)</li></a>
                    </ul>
                <h3>NB PLACES (MIN-MAX)</h3>
                    <ul class="categorie-list">
                        <a href="./achat.php" class="categorie-lien"><li>3 à 6 personnes</li></a>
                        <a href="./achat.php" class="categorie-lien"><li>7 à 12 personnes</li></a>
                        <a href="./achat.php" class="categorie-lien"><li>13 à 24+ personnes</li></a>
                    </ul>
        </div>    
        

        <?php


        echo '<section>';

        echo '<section>';
        echo '<div class="general-p">';

        $sql = "SELECT produits.nom as nom, gammes.nom as gamme_nom, produits.id as id, produits.image as image, produits.prix as prix FROM produits JOIN gammes ON produits.gamme_id = gammes.id WHERE gammes.id = 1";
        $rslt = mysqli_query($conn, $sql);

        $page_retour = 'achat.php';
        while ($produit = mysqli_fetch_assoc($rslt)) {
            include("./includes/parts/box_product.php");
        }

        echo '</div>';  
        echo '</section>';
        ?>


        <?php

        echo '<section>';
        echo '<div class="general-p">';

        $sql = "SELECT produits.nom as nom, gammes.nom as gamme_nom, produits.id as id, produits.image as image, produits.prix as prix FROM produits JOIN gammes ON produits.gamme_id = gammes.id WHERE gammes.id = 2";
        $rslt = mysqli_query($conn, $sql);

        while ($produit = mysqli_fetch_assoc($rslt)) {
            include("./includes/parts/box_product.php");
        }

        echo '</div>';
        echo '</section>';


        echo '</section>';


        ?>


        





    </section>

    

    </main>

    <?php include("./includes/parts/footer.php"); ?>
</body>
</html>