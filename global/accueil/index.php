<?php
session_start();
$_SESSION["genre"] = "";
$_SESSION["objectif"] = "";
$_SESSION["age"] = "";
$_SESSION["habitude"] = "";

// if(isset($_GET)){
//     $_SESSION["genre"] = $_GET;
//     $sessionGenre = $_SESSION;
//     var_dump($sessionGenre);
// } else{
//     "";
// }

require_once("../content/Panier.php");

?>

<?php ob_start(); //NE PAS MODIFIER 

$titre = ""; //Mettre le nom du titre de la page que vous voulez

$panier = new Panier();

?>
<main id="main">
    <div class="slider-container" style="display: none;">
        <div
            class="slide active"
            style="
            background-image: url('https://images.unsplash.com/photo-1610620746460-de78cf3d1705?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2100&q=80');
            "
        ></div>
        <div
            class="slide"
            style="
            background-image: url('https://images.unsplash.com/photo-1609589079958-8192b9cdab91?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=2100&q=80');
            "
        ></div>
        <div
            class="slide"
            style="
            background-image: url('https://images.unsplash.com/photo-1605718665998-85fbd49c5eff?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=2100&q=80');
            "
        ></div>
        <div
            class="slide"
            style="
            background-image: url('https://images.unsplash.com/photo-1609589079852-0b1c745a71ec?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2100&q=80');
            "
        ></div>
        <div
            class="slide"
            style="
            background-image: url('https://images.unsplash.com/photo-1604916010805-18ea15fa6d32?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2100&q=80');
            "
        ></div>
        <button class="arrow left-arrow" id="left">
            <i class="fas fa-arrow-left"></i>
        </button>
        <button class="arrow right-arrow" id="right">
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
    <div id="formulaire-perso">
        <button class="btn btn-dark rounded-circle" id="bouton-fermeture-form-perso"><i class="fas fa-times"></i></button>
    <!-- multistep form -->
        <form method="get" id="msform">
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Genre</li>
            <li>Objectif</li>
            <li>Âge</li>
            <li>Habitude</li>
        </ul>
        <!-- fieldsets -->
            <fieldset id="fieldset-genre">
                <h2 class="fs-title">Vous êtes un(e)?</h2>
                <h3 class="fs-subtitle text-align-center">Répondez a notre petit questionnaire pour accéder a un panel de choix plus sélectif et correspondant a vos attentes.</h3>
                <div>
                    <a href="index.php?genre=Femme" class="liens-choix-genre"><img class="img-choix" src="../../img/femme.jpg" id="img-femme"><span class="span-genre text-uppercase" id="span-femme">Femme</span></a>
                    <a href="index.php?genre=Homme" class="liens-choix-genre"><img class="img-choix" src="../../img/homme.jpg" id="img-homme"><span class="span-genre text-uppercase" id="span-homme">Homme</span></a>
                </div>
                <input type="button" name="next" class="next action-button" id="next1" value="Suivant"/>
            </fieldset>
            <fieldset id="fieldset-age">
                <h2 class="fs-title">Votre âge se situe entre ?</h2>
                <h3 class="fs-subtitle">(Ce n'est que la deuxième question et vous avez déjà fait la moitié !).</h3>
                <a href="index.php?age=20/30" class="liens-choix-age"><img class="img-age" src="../../img/2030.jpg" id="img-2030"><span class="span-genre text-uppercase" id="span-2030">20 / 30</span></a>
                <a href="index.php?age=30/40" class="liens-choix-age"><img class="img-age" src="../../img/3040.jpg" id="img-3040"><span class="span-genre text-uppercase" id="span-3040">30 / 40</span></a>
                <a href="index.php?age=40/50" class="liens-choix-age"><img class="img-age" src="../../img/4050.jpg" id="img-4050"><span class="span-genre text-uppercase" id="span-4050">40 / 50</span></a>

                <input type="button" name="previous" class="previous action-button" value="Précédent" />
                <input type="button" name="next" class="next action-button" id="next2" value="Suivant"/>
            </fieldset>
            <fieldset id="fieldset-obj">
                <h2 class="fs-title">Vous souhaitez ?</h2>
                <h3 class="fs-subtitle">(Courage c'est bientôt la fin !).</h3>

                <a href="index.php?obj=seche" class="liens-choix-obj"><img id="img-seche" class="img-obj" src="../../img/seche.jpg"><span class="span-genre text-uppercase" id="span-seche">Perdre du poids</span></a>
                <a href="index.php?obj=stabi" class="liens-choix-obj"><img id="img-stabi" class="img-obj" src="../../img/stabi.jpg"><span class="span-genre text-uppercase" id="span-stabi">Stabiliser votre poids</span></a>
                <a href="index.php?obj=masse" class="liens-choix-obj"><img id="img-masse" class="img-obj" src="../../img/masse.jpg"><span class="span-genre text-uppercase" id="span-masse">Faire une prise de masse</span></a>

                <input type="button" name="previous" class="previous action-button" value="Précédent" />
                <input type="button" name="next" class="next action-button" id="next3" value="Suivant"/>
            </fieldset>
            <fieldset id="fieldset-hab">
                <h2 class="fs-title">Vos pratiques sportives sont ?</h2>
                <h3 class="fs-subtitle">(C'est la dernière !).</h3>

                <a href="index.php?hab=peu" class="liens-choix-hab"><img id="img-sport1" class="img-habitude" src="../../img/sportif1.jpg"><span class="span-genre text-uppercase" id="span-sport1">Légères</span></a>
                <a href="index.php?hab=moyen" class="liens-choix-hab"><img id="img-sport2" class="img-habitude" src="../../img/sportif2.jpg"><span class="span-genre text-uppercase" id="span-sport2">Moyennes</span></a>
                <a href="index.php?hab=beaucoup" class="liens-choix-hab"><img id="img-sport3" class="img-habitude" src="../../img/sportif3.jpg"><span class="span-genre text-uppercase" id="span-sport3">Régulières</span></a>

                <input type="button" name="previous" class="previous action-button" value="Précédent" />
                <input type="submit" name="submit" class="submit action-button" value="Valider"/>
            </fieldset>
        </form>
    </div>
</main>
<?php
/************************
 * NE PAS MODIFIER
 * PERMET d INCLURE LE MENU ET LE TEMPLATE
 ************************/
    $content = ob_get_clean();
    require "../common/template.php";

?>
