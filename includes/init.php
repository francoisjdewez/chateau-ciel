<?php

// --- Connexion à la base de données ---
// Réglages PAR DÉFAUT pour Laragon en local (serveur MySQL sur la machine).
$host = "localhost";          // Hôte MySQL (localhost sous Laragon)
$user = "root";               // Utilisateur MySQL (root par défaut sous Laragon)
$password = "";               // Mot de passe MySQL (vide par défaut sous Laragon)
$database = "chateau_ciel_db"; // Nom exact de la base

// En ligne (AlwaysData), les VRAIS identifiants viennent d'un fichier à part,
// config.php, qui n'est JAMAIS envoyé sur GitHub (le dépôt est public — voir
// .gitignore). Ce fichier est déposé UNIQUEMENT sur le serveur, par SFTP.
// Modèle disponible dans includes/config.php.exemple.
$configSecret = __DIR__ . '/config.php';
if (file_exists($configSecret)) {
    require $configSecret; // peut redéfinir $host / $user / $password / $database
}

$conn = mysqli_connect($host, $user, $password, $database);


if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");


// --- Petite aide de sécurité ---
// e() échappe une valeur avant de l'afficher dans une page HTML.
// Ça empêche le XSS (du code piégé stocké en base qui s'exécuterait dans le navigateur).
// À utiliser à chaque fois qu'on fait echo d'une donnée venant de la base ou de l'utilisateur.
if (!function_exists('e')) {
    function e($valeur)
    {
        return htmlspecialchars($valeur ?? '', ENT_QUOTES, 'UTF-8');
    }
}

?>
