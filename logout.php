<?php
// Déconnexion : on démarre la session, on la vide, on la détruit,
// puis on renvoie l'utilisateur vers l'accueil.
session_start();
session_unset();
session_destroy();

header("Location: ./index.php");
exit;
