<?php include("verif.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/footer.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/5ef442696c.js" crossorigin="anonymous"></script>
</head>

<body>

<?php include("./includes/init.php"); ?>
<?php include("./includes/parts/header.php"); ?>

<?php
$sql = "SELECT 
            produits.id,
            produits.nom AS produit_nom,
            produits.image,
            produits.prix,
            gammes.nom AS gamme_nom
        FROM produits
        LEFT JOIN gammes ON produits.gamme_id = gammes.id";

$rslt = mysqli_query($conn, $sql);
?>

<main class="ds-total">

    <!-- SIDEBAR -->
    <aside class="dashboard-menu-gauche">

        <a href="./dsh_articles.php" class="dashboard-card active">
            <h2>Articles</h2>
        </a>

        <a href="./dsh_categories.php" class="dashboard-card">
            <h2>Catégories</h2>
        </a>

        <a href="./logout.php" class="dashboard-card">
            <h2>Déconnexion</h2>
        </a>

    </aside>

    <!-- CONTENU -->
    <section class="ds-content">

        <div class="ds-header">

            <h1 class="h1-dashboard">DASHBOARD</h1>

            <button class="ds-actions">
                <span>Nouveau</span>
                <i class="fa-solid fa-plus"></i>
            </button>

        </div>

        <!-- TABLEAU -->
        <div class="tb-ds">

            <table>

                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Gamme</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>

                <tbody>

                    <?php while ($row = mysqli_fetch_assoc($rslt)) { ?>

                        <tr>

                            <td>
                                <img
                                    src="<?= e($row['image']); ?>"
                                    alt="<?= e($row['produit_nom']); ?>"
                                    width="100"
                                >
                            </td>

                            <td><?= e($row['produit_nom']); ?></td>
                            <td><?= number_format($row['prix'], 2, ',', ' '); ?> €</td>
                            <td><?= e($row['gamme_nom']); ?></td>

                            <td>
                                <i class="fa-solid fa-pen-to-square"></i>
                            </td>

                            <td>
                                <i class="fa-solid fa-trash"></i>
                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </section>

</main>

<?php include("./includes/parts/footer.php"); ?>

</body>
</html>