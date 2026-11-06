<?php
require_once __DIR__ . '/includes/session.php';
include("./includes/init.php");

// --- On cherche le produit AVANT tout HTML : sans cela, plus de redirection possible ---
$id = (int) ($_GET['id'] ?? 0);

$sql = "SELECT produits.*, gammes.id AS gamme_id, gammes.nom AS gamme_nom
        FROM produits
        JOIN gammes ON produits.gamme_id = gammes.id
        WHERE produits.id = $id
        ";
$rslt = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($rslt);

if (!$row) {
    header('Location: achat.php');
    exit;
}

$gamme_id = (int) $row['gamme_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product.php</title>
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
    <?php include("./includes/parts/header.php"); ?>

    <main class="wrapper small-margin">

        <div class="main-product">

            <div class="main-left">
                <img src="<?php echo e($row['image']); ?>">
            </div>


            <div class="main-right">

                <h1 class="h1-product"><?php echo e($row['nom']); ?></h1>

                <p><?php echo e($row['description']); ?></p>

                <div class="price">
                    <p><?php echo prix_format($row['prix']); ?></p>
                </div>

                <form action="./panier.php" method="post" class="btn-principal">
                    <input type="hidden" name="action" value="ajouter">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="retour" value="product.php?id=<?php echo $id; ?>">
                    <input type="hidden" name="jeton" value="<?php echo e(panier_jeton()); ?>">

                    <button type="button" data-quantite="-1" class="btn-produit btn-produit-clair trans-bg-color" aria-label="Diminuer la quantité">-</button>

                    <input type="number" name="quantite" value="1" min="1" max="<?php echo PANIER_QUANTITE_MAX; ?>" class="quantite-champ" aria-label="Quantité">

                    <button type="button" data-quantite="1" class="btn-produit btn-produit-clair trans-bg-color" aria-label="Augmenter la quantité">+</button>

                    <button type="submit" class="btn-produit btn-produit-fonce" aria-label="Ajouter au panier">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </form>


            </div>

        </div>



        <?php 


        $sql_gamme = "  SELECT *
                        FROM produits
                        WHERE gamme_id = $gamme_id
                        AND id != $id
                        ";

        $rslt_gamme = mysqli_query($conn, $sql_gamme);

        
        ?>
        

        <div>

        <h2 class="title-suggestion">LES PRODUITS QUI POURRAIENT VOUS PLAIRE...</h2>

        </div>



        <div>
            <div class="general product-page">


            <?php
            $page_retour = 'product.php?id=' . $id;
            while ($produit = mysqli_fetch_assoc($rslt_gamme)) {
                include("./includes/parts/box_product.php");
            }
            ?>



            </div>
        </div>


    </main>



    <?php include("./includes/parts/footer.php"); ?>
    <script src="assets/js/quantite.js"></script>
</body>
</html>