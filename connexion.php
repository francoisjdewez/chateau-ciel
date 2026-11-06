<?php
require_once __DIR__ . '/includes/session.php';
include("./includes/init.php");

// --- Connexion traitée AVANT tout HTML : la redirection doit partir en premier ---
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mail = $_POST["mail"];
    $password = $_POST["password"];

    $mail = mysqli_real_escape_string($conn, $mail);
    $sql = "SELECT * FROM users WHERE mail='$mail'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["mot_de_passe"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["prenom"] = $user["prenom"];
            $_SESSION["role"] = $user["role"];

            header("Location: index.php");
            exit;

        } else {
            $error = "Mot de passe incorrect";
        }

    } else {
        $error = "Aucun compte trouvé avec cet email";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion.php</title>
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

    <?php echo e($error); ?>

    <main class="main-form wrapper">

    <h1 class="h1-form">CONNEXION</h1>

    <form action="./connexion.php" method="post" class="form-connexion">

            <label for="mail">Email*</label>
            <input type="text" name="mail" id="mail" required /> 

            <label for="">Mot de passe*</label>
            <input type="password" name="password" id="password" required /> 

            <p class="lien-form">
                Vous n'avez pas encore de compte ? 
                <a href="./profil.php">    
                    Cliquez ici pour vous inscrire 
                </a>
            </p>

            <section class="btn-form">
                <div>
                    <button type="submit" class="button-cta-container button-cta-item">Se connecter</button>
                </div>

                <div>
                    <button type="reset" class="button-cta-container button-cta-item">Annuler</button>
                </div>
            </section>

    </form>

    </main>

    <?php include("./includes/parts/footer.php"); ?>
</body>
</html>