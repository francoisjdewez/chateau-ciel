<?php
// Carte produit réutilisée sur l'accueil, la boutique et les suggestions.
// La page qui l'inclut fournit $produit (id, nom, image, prix)
// et $page_retour (la page où revenir après l'ajout au panier).
$lien_produit = './product.php?id=' . (int) $produit['id'];
?>
<article class="product">
    <a href="<?php echo $lien_produit; ?>">
        <img src="<?php echo e($produit['image']); ?>" alt="<?php echo e($produit['nom']); ?>">
    </a>

    <div class="product-element trans-color">
        <a class="product-title" href="<?php echo $lien_produit; ?>">
            <h3><?php echo e($produit['nom']); ?></h3>
        </a>

        <div class="product-elem-price">
            <p><?php echo prix_format($produit['prix']); ?></p>

            <form action="./panier.php" method="post" class="form-carte">
                <input type="hidden" name="action" value="ajouter">
                <input type="hidden" name="id" value="<?php echo (int) $produit['id']; ?>">
                <input type="hidden" name="quantite" value="1">
                <input type="hidden" name="retour" value="<?php echo e($page_retour); ?>">
                <input type="hidden" name="jeton" value="<?php echo e(panier_jeton()); ?>">
                <button type="submit" class="btn-carte" aria-label="Ajouter <?php echo e($produit['nom']); ?> au panier">
                    <i class="fa-solid fa-basket-shopping"></i>
                </button>
            </form>
        </div>
    </div>
</article>
