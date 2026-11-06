<?php require_once __DIR__ . '/includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil.php</title>
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
    <?php include("./includes/init.php");?>
    <?php include("./includes/parts/header.php"); ?>


    <?php 
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $mail = $_POST["mail"];
        $telephone = $_POST['telephone'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // On vérifie si l'email existe déjà — REQUÊTE PRÉPARÉE.
        // Le "?" est un emplacement : la valeur $mail est envoyée à part (bind_param),
        // donc elle ne peut jamais être interprétée comme du code SQL (fini l'injection).
        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE mail = ?");
        mysqli_stmt_bind_param($check, "s", $mail); // "s" = string (texte)
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            echo "Email déjà utilisé";
        } else {

            // Insertion du nouveau compte — REQUÊTE PRÉPARÉE elle aussi.
            $sql = mysqli_prepare(
                $conn,
                "INSERT INTO users (nom, prenom, mail, telephone, mot_de_passe, role, date_created)
                 VALUES (?, ?, ?, ?, ?, 'user', NOW())"
            );
            // "sssss" = 5 chaînes de texte, dans l'ordre des "?"
            mysqli_stmt_bind_param($sql, "sssss", $nom, $prenom, $mail, $telephone, $password);
            mysqli_stmt_execute($sql);

            echo "Compte créé avec succès";
        }

    }

    ?>

    <main class="main-form wrapper">

        <h1 class="h1-form">INSCRIPTION</h1>

        <form action="./profil.php" method="post" class="form-inscription">
            
            <label for="prenom">Prénom*</label>
            <input  type="text" name="prenom" id="prenom" required /> 

            <label for="nom">Nom*</label>
            <input type="text" name="nom" id="nom" required /> 

            <label for="mail">Email*</label>
            <input type="text" name="mail" id="mail" required />
            
            <label for="telephone">Telephone*</label>
            <input type="text" name="telephone" id="telephone" required /> 

            <label for="">Mot de passe*</label>
            <input type="password" name="password" id="password" required /> 

            <p class="lien-form">
                Vous avez déja un compte ? 
                <a href="./connexion.php">    
                    Cliquez ici pour vous connecter 
                </a>
            </p>

            <section class="btn-form">
                <div>
                    <button type="submit" class="button-cta-container button-cta-item">S'inscrire</button>
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