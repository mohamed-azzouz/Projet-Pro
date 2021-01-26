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
        var_dump("test1");
        if($verif == "ok"){
            var_dump("test2");
            $inscrit = $user->inscription();
            if($inscrit == "ok"){
                var_dump("test3");
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
            echo "bravo vous êtes connecté";
        } else {
            echo "problème lors de la connexion";
        }
    }
}


?>

<form action="" method="post">
    <input type="text" name="nom" placeholder="Nom...">
    <input type="text" name="prenom" placeholder="Prénom...">
    <input type="password" name="mdp" placeholder="Mot de passe...">
    <input type="password" name="mdp2" placeholder="Confirmer...">
    <input type="email" name="email" placeholder="Email...">
    <input type="tel" name="tel" pattern="0[1-68]([-. ]?[0-9]{2}){4}">
    <input type="submit" name="inscription" value="S'inscrire">
    <?php if(isset($error)){echo $error;} ?>
</form>

<form action="" method="post">
    <input type="mail" name="mail" placeholder="Mail...">
    <input type="password" name="password" placeholder="Mot de passe...">
    <input type="submit" name="connexion" value="Se connecter">
</form>

<?php
/************************
 * NE PAS MODIFIER
 * PERMET d INCLURE LE MENU ET LE TEMPLATE
 ************************/
    $content = ob_get_clean();
    require "../common/template.php";
?>
