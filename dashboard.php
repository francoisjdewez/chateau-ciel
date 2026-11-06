<?php include"verif.php" ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5ef442696c.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("./includes/init.php"); ?>
    <?php include("./includes/parts/header.php"); ?>

    


    <main>


        <div class="ds-main">

            <h1 class="h1-dashboard">DASHBOARD</h1> 


        </div>

        <div class="dashboard-menu-gauche">

            <a href="./dsh_articles.php" class="dashboard-card">
                <h2>Articles</h2>
            </a>


            <a href="./dsh_categories.php" class="dashboard-card">
                <h2>Catégories</h2>
            </a>

            <a href="">
                <h2>Déconnexion</h2>
            </a>
        </div>


    </main>


    <?php include("./includes/parts/footer.php"); ?>

</body>
</html>