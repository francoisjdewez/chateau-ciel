<header>

        <div class="logo">
            <a href="./index.php" ><img src="assets/img/newlogo2.png" alt="logo"></a>
        </div>
        
        <div class="header-menu">
            <nav>
                    <ul class="header-nav trans-color">
                        <li><a href="./index.php" >ACCUEIL</a></li>
                        <li><a href="./achat.php" >BOUTIQUE</a></li>
                        <li><a href="./presentation.php" >À PROPOS</a></li>
                    </ul>
            </nav>
        </div>

        <div class ="header-bouton trans-color">
            <?php $nombre_articles = panier_nombre_articles(); ?>
            <a href="./panier.php" class="lien-panier" aria-label="Panier : <?php echo $nombre_articles; ?> article(s)">
                <i class="fa-solid fa-cart-shopping"></i>
                <?php if ($nombre_articles > 0) : ?>
                    <span class="panier-compteur"><?php echo $nombre_articles; ?></span>
                <?php endif; ?>
            </a>
            <a href="./profil.php" ><i class="fa-regular fa-circle-user"></i></a>
        </div>

        <div class="header-dasboard">
            <?php if (isset($_SESSION["user_id"])) : ?>
                <a href="<?= ($_SESSION["role"] === "admin") ? './dashboard.php' : './dashboard.php' ?>">
                    <?= htmlspecialchars($_SESSION["prenom"]) ?>
                </a>
            <?php endif; ?>

        </div>

    </header>

    <?php $message = message_lire(); ?>
    <?php if ($message !== '') : ?>
        <div class="message-site" role="status">
            <span><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></span>
            <a href="./panier.php">Voir le panier</a>
        </div>
    <?php endif; ?>

    