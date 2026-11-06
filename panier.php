<?php
require_once __DIR__ . '/includes/session.php';
include("./includes/init.php");

// --- Traitement des actions, avant tout HTML pour pouvoir rediriger ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Seules ces pages sont acceptées comme retour : on ne renvoie jamais
    // le visiteur vers une adresse extérieure glissée dans le formulaire.
    $retour = $_POST['retour'] ?? '';
    if (!preg_match('/^(index\.php|achat\.php|panier\.php|product\.php\?id=\d+)$/', $retour)) {
        $retour = 'panier.php';
    }

    $jeton = $_POST['jeton'] ?? '';
    if (!is_string($jeton) || !hash_equals(panier_jeton(), $jeton)) {
        message_definir("Votre session a expiré, veuillez réessayer.");
        header('Location: ' . $retour);
        exit;
    }

    $action = $_POST['action'] ?? '';
    $id = (int) ($_POST['id'] ?? 0);
    $dans_panier = isset($_SESSION['panier'][$id]);

    if ($action === 'ajouter') {
        // Requête préparée : on vérifie que le produit existe vraiment.
        $requete = mysqli_prepare($conn, "SELECT nom FROM produits WHERE id = ?");
        mysqli_stmt_bind_param($requete, "i", $id);
        mysqli_stmt_execute($requete);
        $produit = mysqli_fetch_assoc(mysqli_stmt_get_result($requete));

        $quantite = (int) ($_POST['quantite'] ?? 1);

        if ($produit && $quantite >= 1) {
            panier_ajouter($id, $quantite);
            message_definir($produit['nom'] . " a été ajouté au panier.");
        } else {
            message_definir("Ce produit n'a pas pu être ajouté.");
        }

    } elseif ($action === 'augmenter' && $dans_panier) {
        panier_modifier($id, $_SESSION['panier'][$id] + 1);

    } elseif ($action === 'diminuer' && $dans_panier) {
        panier_modifier($id, $_SESSION['panier'][$id] - 1);

    } elseif ($action === 'supprimer') {
        panier_modifier($id, 0);
    }

    // Redirection après POST : actualiser la page ne renvoie pas le formulaire.
    header('Location: ' . $retour);
    exit;
}

$contenu = panier_contenu($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Château Ciel</title>
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


    <main class="wrapper small-margin panier">

        <h1 class="h1-index">PANIER</h1>

        <?php if (empty($contenu['lignes'])) : ?>

            <div class="panier-vide">
                <p>Votre panier est vide.</p>
                <a href="./achat.php" class="button-cta-item">VOIR PRODUITS</a>
            </div>

        <?php else : ?>

            <?php foreach ($contenu['lignes'] as $ligne) : ?>
                <?php $lien_produit = './product.php?id=' . (int) $ligne['id']; ?>
                <article class="panier-ligne">

                    <a href="<?php echo $lien_produit; ?>" class="panier-image">
                        <img src="<?php echo e($ligne['image']); ?>" alt="<?php echo e($ligne['nom']); ?>">
                    </a>

                    <div class="panier-infos">
                        <h2><a href="<?php echo $lien_produit; ?>"><?php echo e($ligne['nom']); ?></a></h2>
                        <p><?php echo prix_format($ligne['prix']); ?> / pièce</p>
                    </div>

                    <form action="./panier.php" method="post" class="panier-actions">
                        <input type="hidden" name="id" value="<?php echo (int) $ligne['id']; ?>">
                        <input type="hidden" name="retour" value="panier.php">
                        <input type="hidden" name="jeton" value="<?php echo e(panier_jeton()); ?>">

                        <button type="submit" name="action" value="diminuer" class="btn-produit btn-produit-clair trans-bg-color" aria-label="Retirer un exemplaire">-</button>
                        <p class="panier-quantite"><?php echo (int) $ligne['quantite']; ?></p>
                        <button type="submit" name="action" value="augmenter" class="btn-produit btn-produit-clair trans-bg-color" aria-label="Ajouter un exemplaire"<?php echo $ligne['quantite'] >= PANIER_QUANTITE_MAX ? ' disabled' : ''; ?>>+</button>
                        <button type="submit" name="action" value="supprimer" class="panier-supprimer" aria-label="Supprimer <?php echo e($ligne['nom']); ?> du panier">
                            <i class="fa-solid fa-trash"></i> Supprimer
                        </button>
                    </form>

                    <p class="panier-sous-total"><?php echo prix_format($ligne['sous_total']); ?></p>

                </article>
            <?php endforeach; ?>

            <div class="panier-total">
                <p>Total : <strong><?php echo prix_format($contenu['total']); ?></strong></p>
                <a href="./achat.php" class="button-cta-item">CONTINUER MES ACHATS</a>
            </div>

        <?php endif; ?>

    </main>

    <?php include("./includes/parts/footer.php"); ?>
</body>
</html>
