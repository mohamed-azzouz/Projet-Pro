<?php ob_start(); //NE PAS MODIFIER 
    $url = $_SERVER['PHP_SELF']; 
    $reg = '#^(.+[\\\/])*([^\\\/]+)$#';
    $url_reduit = preg_replace($reg, '$2', $url);
    $page_actuelle = substr($url_reduit,0,-4);
$titre = "<a href='index.php'>Accueil</a> / <a href'#'>$page_actuelle</a>"; //Mettre le nom du titre de la page que vous voulez
?>

<?php
require("Database.php");
require("Plat_classe.php");
require("PlatDAO.php");
require("Panier.php");

$panier = new Panier();



?>
<main id="main-plat">
    <section>
        <article id="art-plat">
            <p>Retour</p>
            <div id="box-plat">
                <img src="../../img/<?= $plat["image"]; ?>" id="img-art-plat" alt="">
                <div id="box-plat-nomdescprix">   
                    <h5 id="title-plat-nom"><?= $plat["nom"]; ?></h5>
                    <p id="plat-desc"><?= $plat["description"]; ?></p>
                    <p><?= $plat["prix"]; ?>€</p>
                </div>
            </div>
        </article>
    </section>
</main>




<?php
/************************
 * NE PAS MODIFIER
 * PERMET d INCLURE LE MENU ET LE TEMPLATE
 ************************/
    $content = ob_get_clean();
    require "../common/template.php";
?>
