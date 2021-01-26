<?php
    require_once("../content/Database.php");
    require_once("../content/Plat_classe.php");
    require_once("../content/PlatDAO.php");
    require_once("../content/Panier.php");

    $categories = PlatDAO::getCat();
?>
<header id="header" class="position-sticky sticky-top">

    <nav class="navbar navbar-expand-lg bg-light" id="el-menu">
        <a class="navbar-brand" id="kabsaNavLogo" href="../accueil/index.php"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav navigation">
                <li class="nav-item dropdown toggleSubMenu"><a href="../content/plats.php" class="span-repas liste-header-nav p-3  text-body">Repas</a>
                        <ul class="subMenu">
                            <?php  foreach($categories as $cat):?>
                                <li class="liste-sous-menu-repas">
                                    <a href="#" class="repas-lien">
                                        <img class="repas-menu-img" src="../../img/<?= $cat["image"]; ?>" alt="">
                                        <p class="para-sous-menu-repas" title="Aller à la page 3.1"><?= $cat["nom"]; ?></p>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <li class="nav-item dropdown">
                    <a class="nav-link liste-header-nav p-3 text-body" href="#">A propos de nous</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link liste-header-nav p-3 text-body" href="#">Menu</a>
                </li>
                <li class="nav-item dropdown" id="liste-appel">
                        <p class="paragraphe-appel" id="para-appel1">06 29 33 75 30</p>
                        <p class="paragraphe-appel" id="para-appel2">prix d'un appel local</p>
                    </li>
                <li class="nav-item dropdown">
                    <a class="nav-link  liste-header-nav p-3 text-body disabled" href="#">Compte</a>
                </li>
            </ul>
        </div>
    </nav>
</header>