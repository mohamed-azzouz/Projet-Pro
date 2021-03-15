<?php ob_start(); //NE PAS MODIFIER 
session_start();
$url = $_SERVER['PHP_SELF']; 
$reg = '#^(.+[\\\/])*([^\\\/]+)$#';
$url_reduit = preg_replace($reg, '$2', $url);
$page_actuelle = substr($url_reduit,0,-4);
$titre = "<a class='lien-accueil' href='index.php'>Accueil</a> / <a href'#'>$page_actuelle</a>"; //Mettre le nom du titre de la page que vous voulez

date_default_timezone_set('UTC');
setlocale(LC_TIME, "fr_FR");

require_once("Database.php");
require_once("Plat_classe.php");
require_once("PlatDAO.php");
require_once("Panier.php");

$panier = new Panier();
$platsModal = array();
$plats = PlatDAO::getPlatBD();
foreach($plats as $plat){
    new Plat($plat["id"],$plat["nom"],$plat["image"],$plat["description"],$plat["prix"],$plat["id_categorie_plat"]);
    $platModal = PlatDAO::getPlat($plat["id"]);
    array_push($platsModal, $platModal);
}


$hActuelle = date("h");
$heureActuelle = $hActuelle + 1;

if(isset($_POST["adresse"]) && !empty($_POST["adresse"]) && isset($_POST["jour"]) && !empty($_POST["jour"]) && isset($_POST["heure"]) && !empty($_POST["heure"])){
    
    $adresse = htmlentities($_POST["adresse"]);
    $jour = htmlentities($_POST["jour"]);
    $heure = htmlentities($_POST["heure"]);
    unset($_POST);
    if($heureActuelle > 17 && (int)$jour === 1){
        echo "l'heure de reservation maximum requise pour réserver le lendemain est dépassée";
    } else {
        $_SESSION["adresse"] = $adresse."<br/>";
        $_SESSION["jour"] = $jour."<br/>";
        $_SESSION["heure"] = $heure."<br/>";
        // echo $_SESSION["adresse"];
        // echo $_SESSION["jour"];
        // echo $_SESSION["heure"];
    }
} else {
    echo "Veuillez renseigner tout les champs";
}

$search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
$replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');



?>

<main id="main-plats">
    <section id="section-plats">
        <form action="" method="post" id="form-horaire">
            <input type="text" id="adresse" name="adresse" placeholder="Renseignez votre adresse">
            <div id="page">
                <nav id="navMain">
                    <ul>
                        <li><a href="#"><i class="far fa-calendar-check"></i><?= isset($_SESSION["jour"]) && !empty($_SESSION["jour"]) ? $_SESSION["jour"] : "Demain" ; ?></a>
                            <ul id="liste-jours">
                                <?php for($i=1;$i<=7;$i++): ?>
                                    <li>
                                        <input id="jour" type="radio" name="jour" value="<?= ucfirst(strftime('%A %d',strtotime('+'.$i.' day'))); if(isset($_POST["jour"])){if($_POST["jour"] == 1){echo "checked";}}?>">
                                        <label for="<?= $i ?>"><?= ($i === 1) ? "Demain": ucfirst(strftime('%A %d',strtotime('+'.$i.' day')));?></label>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            
            </select>
            <select name="heure" id="heure">
                <option value=""><?= isset($_SESSION["heure"]) && !empty($_SESSION["jour"])?$_SESSION["heure"]:"A qu'elle heure ?"; ?></option>
                <option value="10h-11h">10h-11h</option>
                <option value="11h-12h">11h-12h</option>
                <option value="12h-13h">12h-13h</option>
                <option value="13h-14h">13h-14h</option>
            </select>
            <button type="submit" id="subTimePlat">OK</button>
        </form>
        <div class="row no-gutters" id="all-plats">
            <?php  $x = 0;?>
            <?php foreach(Plat::$mesPlats as $plat):?>
                <div class="col-3 d-flex justify-content-center">
                    <div class="card my-4 border border-dark">
                        <a href="#" id="<?= $plat->getId(); ?>" class="lien-card-img" data-toggle="modal" data-target="#modalPlat<?=$x ?>"><img class="card-img-top img-page-plats" src="../../img/<?= $plat->getImage(); ?>" alt="Card image cap"></a>
                        <?php
                            $pdo = monPDO::getPDO();
                            $sql = "SELECT nom from categories_plats WHERE id = :id";
                            $req = $pdo->prepare($sql);
                            $req->execute([
                                "id" => $plat->getIdcat()
                            ]);
                            $cat = $req->fetch(PDO::FETCH_ASSOC);

                            
                            $choix = PLatDAO::getChoix($plat->getId());
                        ?>
                        <span class="display-cat-plat py-1 px-2"><?= $cat["nom"]; ?></span>
                    
                        <form id="form-boxradio" method="POST" action="checkbox.php">
                         
                            <?php foreach($choix as $ch):
                                $idChoix = $ch["id"];
                                $typeChoix = PlatDAO::getTypeChoix($idChoix); ?>
                                <label for="<?= $ch["nom"]; ?>"><?= $ch["nom"]; ?></label></br>
                                <div>
                                <?php $choixId_sans_accent = str_replace($search, $replace, $ch["nom"]); ?>
                                <?php $choixClass_sans_accent = str_replace($search, $replace, $ch["nom"]); ?>
                                <?php foreach($typeChoix as $index => $tch): ?>
                                    <?= ($ch["nom"] === "féculent" || $ch["nom"] === "protéines")? "<input type='radio' id='".$choixId_sans_accent.$index."' class='".$choixClass_sans_accent."' name='".$ch['nom']."' value='".$tch['nom']."'>": "<input type='checkbox' id='".$choixId_sans_accent.$index."' class='".$choixClass_sans_accent."' name='".$tch['nom']."'>";?>
                                    <label for="<?= $ch['nom']; ?>"><?= $tch["nom"]; ?></label></br>
                                <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </form>
                        <div class="card-body">
                        
                            <h6 class="card-title"><?= $plat->getNom(); ?></h6>
                            <div class="d-flex justify-content-between align-items-center">                
                                <p class="card-text m-0"><?= $plat->getPrix(); ?> euros</p>
                                <div class="box-qt-plats">
                                    <a id="btn-moins-qt-plats" class="add btn del addPanier" href="delpanier.php?id=<?=$plat->getId(); ?>"><i class="fas fa-minus"></i></a>
                                    <span><input class="inp-qt-panier" type="text" name="panier[quantity][<?= $plat->getId();  ?>]" value="<?= (!isset($_SESSION['panier'][$plat->getId()])) ? 0 : $_SESSION['panier'][$plat->getId()]; ?>" disabled></span>
                                    <a class="add addPanier btn-plus-qt-plats" href="addpanier.php?id=<?= $plat->getId(); ?>"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php $x++;?>
            <?php endforeach; ?>
        </div>




        <!-- MODAL -->

        <?php for($x = 0; $x < count($platsModal); $x++):
            $modalPlatI = 'modalPlat'.$x; ?>
            <div class="modal fade" id="<?= $modalPlatI; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabelPlat" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <article class="articleModal">
                            <div class="modal-header">
                                <img src="../../img/<?= $platsModal[$x]["image"]; ?>" id="img-art-plat" alt="">
                            </div>
                            <div class="modal-body">
                                <h5 id="title-plat-nom"><?= $platsModal[$x]["nom"]; ?></h5>
                                <p class="para-description-modal"><?= $platsModal[$x]["description"]; ?></p>
                                <p class="para-prix-modal">Prix : <?=$platsModal[$x]["prix"]; ?> euros</p>
                            </div>
                            <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                    <span class="spanBtnModal" aria-hidden="true">&times;</span>
                            </button>
                        </article>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>

                            <a id="btn-moins-qt-plats" class="add btn del addPanier" href="delpanier.php?id=<?=$platsModal[$x]["id"]; ?>"><i class="fas fa-minus"></i></a>
                            
                            <span><input class="inp-qt-panier" type="text" name="panier[quantity][<?= $platsModal[$x]["id"];  ?>]" value="<?= (!isset($_SESSION['panier'][$platsModal[$x]["id"]])) ? 0 : $_SESSION['panier'][$platsModal[$x]["id"]]; ?>" disabled></span>

                            <a class="add addPanier btn-plus-qt-plats" href="addpanier.php?id=<?= $platsModal[$x]["id"]; ?>"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endfor; ?>
     
        <!-- FIN MODAL -->

    </section>
    <section id="section-plats-panier">
        <article id="panier-top-article">
            <div id="panier-top-box" class="row justify-content-end pt-3">                     
                <span id="count" class="text-uppercase font-weight-bold"><?= $panier->count() ?> plats&nbsp;</span>
                <span id="total" class="font-weight-bold">(<?= $panier->total(); ?>€)</span>
            </div>
            
            <button type="submit" class="btn btn-warning font-weight-bold mt-3 mb-4 justify-content-center text-uppercase" name="validerPanier">Valider le panier</button>
        </article>
        <article>
            <div class="wrap">
                <?php
                $id_session = array_keys($_SESSION["panier"]);
                $id = implode(",",$id_session);
                if(empty($id_session)){
                    $plats = [];
                }else{
                    $pdo = monPDO::getPDO();
                    $sql = "SELECT * FROM plats WHERE id IN ($id)";
                    $req = $pdo->prepare($sql);
                    $req->execute();
                    $plats = $req->fetchAll(PDO::FETCH_ASSOC);
                }

                foreach($plats as $plat): ?>
                        <div class="box-elements-panier">
                            <img src="../../img/<?= $plat["image"]; ?>" alt="" id="img-panier">
                            <p id="para-name-panier"><?= $plat["nom"] ?></p>
                            <span><?= $plat["prix"]*$_SESSION["panier"][$plat["id"]]; ?>€</span>
                            <form id="form-add-del-panier" method="post">
                                <a id="btn-moins-qt-panier" class="add btn del addPanier" href="delpanier.php?id=<?=$plat['id']?>"><i class="fas fa-minus"></i></a>
                                <span>
                                    <input class="inp-qt-panier" type="text" name="panier[quantity][<?= $plat['id'];  ?>]" value="<?= $_SESSION['panier'][$plat['id']]; ?>" disabled>
                                </span>
                                <a id="btn-plus-qt-panier" class="add btn addPanier" href="addpanier.php?id=<?=$plat['id']?>"><i class="fas fa-plus"></i></a>
                            </form>
                        </div>
                        <?= 
                        var_dump($_SESSION["panier"]);
                        var_dump($_SESSION["panier"][$plat["id"]]); ?>
                        <!-- <div>
                            <?php if(isset($plat["id"]) && $plat["id"] == 13):
                                if(isset($_SESSION["feculent"]) && isset($_SESSION["proteine"])):
                                    if(isset($_SESSION["avocat"]) || isset($_SESSION["carotte"]) || isset($_SESSION["patate_douce"]) || isset($_SESSION["haricots"])): ?>
                                        <h6>Choix du féculent</h6>
                                        <ul>
                                            <li>
                                                <?= $_SESSION["feculent"]; ?>
                                            </li>
                                        </ul>
                                        <h6>choix du/des légume(s)</h6>
                                            <ul>
                                                <?= (isset($_SESSION["avocat"])) ? "<li>".$_SESSION["avocat"]."</li>" : "" ;?>
                                                <?= (isset($_SESSION["carotte"])) ? "<li>".$_SESSION["carotte"]."</li>" : "" ; ?>
                                                <?= (isset($_SESSION["patate_douce"])) ? "<li>".$_SESSION["patate_douce"]."</li>" : "" ; ?>
                                                <?= (isset($_SESSION["haricots"])) ? "<li>".$_SESSION["haricots"]."</li>" : "" ; ?>
                                            </ul>
                                        <h6>choix de la protéine</h6>
                                            <ul>
                                                <li>
                                                    <?= $_SESSION["proteine"]; ?>
                                                </li>
                                            </ul>
                                    <?php endif;
                                endif;
                            endif; ?>
                        </div> -->
                <?php endforeach;?>
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
