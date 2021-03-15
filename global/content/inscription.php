<?php ob_start(); //NE PAS MODIFIER 
session_start();
$url = $_SERVER['PHP_SELF']; 
$reg = '#^(.+[\\\/])*([^\\\/]+)$#';
$url_reduit = preg_replace($reg, '$2', $url);
$page_actuelle = substr($url_reduit,0,-4);
$titre = "<a class='lien-accueil' href='index.php'>Accueil</a> / <a href'#'>$page_actuelle</a>"; //Mettre le nom du titre de la page que vous voulez

require_once("User.php");


if(isset($_POST["inscription"])){
    $user = new Users($_POST["nom"],$_POST["prenom"],$_POST["mdp"],$_POST["mdp2"],$_POST["email"],$_POST["tel"]);
    if(!empty($_POST["nom"]) && isset($_POST["nom"]) && !empty($_POST["prenom"]) && isset($_POST["prenom"]) && !empty($_POST["mdp"]) && isset($_POST["mdp"]) && !empty($_POST["mdp2"]) && isset($_POST["mdp2"]) && !empty($_POST["email"]) && isset($_POST["email"]) && !empty($_POST["tel"]) && isset($_POST["tel"])){
        $verif = $user->verify();
        if($verif == "ok"){
            $inscrit = $user->inscription();
            if($inscrit == "ok"){
                header("Location: inscription.php");
            }
        } else {
            $error = $verif;
        }
    }
}


if(isset($_POST["connexion"])){
    $user = new Users("","","","",$_POST["mail"],"",$_POST["password"]);
    if(isset($_POST["mail"]) && isset($_POST["password"])){
        $co = $user->connect();
        if($co == "ok"){
            $_SESSION["login"] = $user;
            echo "bravo vous êtes connecté";
        } else {
            echo $co;
            echo "problème lors de la connexion";
        }
    }
}


?>
<section class="d-flex justify-content-center">
    <div id="co-sub-box">
        <form action="" method="post" class="d-flex flex-column justify-content-between" style="height: 21em;">
            <h5 class="text-center">L'inscription</h5>

            <div class="d-flex">
                <div class="input-form mr-2">
                    <input type="text" name="nom" placeholder=" ">
                    <label for="nom">Nom</label>
                </div>
                <div class="input-form">
                    <input type="text" name="prenom" placeholder=" ">
                    <label for="prenom">Prénom</label>
                </div>
            </div>
            <article class="d-flex">
                <div class="mr-2 d-flex flex-column justify-content-around" style="height:10em;">
                    <div class="input-form">
                        <input type="password" name="mdp" placeholder=" ">
                        <label for="mdp">Mot de passe</label>
                    </div>
                    <div class="input-form">
                        <input type="password" name="mdp2" placeholder=" ">
                        <label for="mdp2">Confirmer le mot de passe</label>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-around" style="height:10em;">
                    <div class="input-form">
                        <input type="email" name="email" placeholder=" ">
                        <label for="email">Adresse email</label>
                    </div>
                    <div class="input-form">
                        <input type="tel" name="tel" placeholder=" " pattern="0[1-68]([-. ]?[0-9]{2}){4}">
                        <label for="tel">Numéro de téléphone</label>
                    </div>
                </div>
            </article>       
            <div class="submit-form">
                <button type="submit" name="inscription">Inscription</button>
                <?php if(isset($error)){echo $error;} ?>
            </div>
        </form>

        <form action="" method="post" class="d-flex flex-column justify-content-between">
            <h5 class="text-center">La connexion</h5>
            <div class="d-flex flex-column" style="height: 11em;">
                <div class="input-form">
                    <input type="mail" id="mail" name="mail" placeholder=" " required>
                    <label for="mail">Adresse email</label>
                </div>
                <div class="input-form">
                    <input type="password" id="password" name="password" placeholder=" " required>
                    <label for="password">Mot de passe</label>
                </div>
            </div>
            
            <div class="submit-form">
                <button type="submit" name="connexion">Connexion</button>
            </div>
        </form>
    </div>
</section>



<?php
/************************
 * NE PAS MODIFIER
 * PERMET d INCLURE LE MENU ET LE TEMPLATE
 ************************/
    $content = ob_get_clean();
    require "../common/template.php";
?>
