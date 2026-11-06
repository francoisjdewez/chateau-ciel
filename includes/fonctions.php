<?php
// Fonctions du panier.
// Le panier vit dans la session sous la forme [id du produit => quantité].
// Le prix n'y est jamais stocké : il est relu en base à chaque affichage.

const PANIER_QUANTITE_MAX = 99;

// Nombre total d'articles, affiché dans l'en-tête (2 + 1 = 3 articles).
function panier_nombre_articles()
{
    return array_sum($_SESSION['panier'] ?? []);
}

// Ajoute une quantité à un produit, sans dépasser le maximum.
function panier_ajouter($id, $quantite)
{
    $actuelle = $_SESSION['panier'][$id] ?? 0;
    $_SESSION['panier'][$id] = min($actuelle + $quantite, PANIER_QUANTITE_MAX);
}

// Change la quantité d'un produit du panier. À zéro, la ligne disparaît.
function panier_modifier($id, $quantite)
{
    if ($quantite <= 0) {
        unset($_SESSION['panier'][$id]);
    } else {
        $_SESSION['panier'][$id] = min($quantite, PANIER_QUANTITE_MAX);
    }
}

// Renvoie les lignes à afficher et le total, avec les prix de la base.
// Un produit supprimé du catalogue entre-temps est retiré du panier.
function panier_contenu($conn)
{
    $lignes = [];
    $total = 0;
    $panier = $_SESSION['panier'] ?? [];

    if (empty($panier)) {
        return ['lignes' => $lignes, 'total' => $total];
    }

    // intval garantit que seuls des nombres entrent dans la requête.
    $ids = implode(',', array_map('intval', array_keys($panier)));
    $resultat = mysqli_query($conn, "SELECT id, nom, image, prix FROM produits WHERE id IN ($ids)");

    $trouves = [];
    while ($produit = mysqli_fetch_assoc($resultat)) {
        $id = (int) $produit['id'];
        $trouves[$id] = true;
        $produit['quantite'] = $panier[$id];
        $produit['sous_total'] = $produit['prix'] * $panier[$id];
        $total += $produit['sous_total'];
        $lignes[] = $produit;
    }

    foreach (array_keys($panier) as $id) {
        if (!isset($trouves[$id])) {
            unset($_SESSION['panier'][$id]);
        }
    }

    return ['lignes' => $lignes, 'total' => $total];
}

// Jeton anti-CSRF : prouve que le formulaire envoyé vient bien de notre site.
function panier_jeton()
{
    if (empty($_SESSION['jeton_panier'])) {
        $_SESSION['jeton_panier'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['jeton_panier'];
}

// Message affiché une seule fois, sur la page suivante.
function message_definir($texte)
{
    $_SESSION['message'] = $texte;
}

function message_lire()
{
    $texte = $_SESSION['message'] ?? '';
    unset($_SESSION['message']);
    return $texte;
}

// Format belge : 1 299,00 €
function prix_format($prix)
{
    return number_format((float) $prix, 2, ',', ' ') . ' €';
}
