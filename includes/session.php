<?php
// À inclure TOUT EN HAUT de chaque page, avant le moindre caractère de HTML :
// la session s'appuie sur un cookie, et un cookie part dans les en-têtes de la
// réponse, donc avant le contenu de la page.

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,  // le JavaScript ne peut pas lire le cookie de session
        'samesite' => 'Lax', // le cookie n'accompagne pas un POST venu d'un autre site
        'secure'   => !empty($_SERVER['HTTPS']), // HTTPS uniquement quand le site est en HTTPS
    ]);
    session_start();
}

require_once __DIR__ . '/fonctions.php';
