<?php
session_start();

require 'class/bdd.php';
require 'class/user.php';

$user = new user();
$bdd = new bdd();

$bdd->connect();
$id = $_SESSION["id"];
$infoUser = $bdd->execute("SELECT * FROM utilisateurs WHERE id = '$id' ");
var_dump($infoUser);
if ($_SESSION == false) 
{
	header('Location:index.php');
}

$id = $_SESSION["id"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body id="bodyProfil">
	<main id="mainProfil">

		<div id="titleProfil"> MODIFIER MES INFORMATIONS</div>
		<hr>
		<section id="allDivProfil">
			
			<section id="infoCompte">
				<p>INFORMATION DU COMPTE</p>
				<form method="post" action="" id="formInfo">	
				<?php
				
				$getCivilite = $bdd->execute("SELECT civilite FROM utilisateurs WHERE id = '$id' ");
				if ($getCivilite[0][0] == 1) 
				{?>
					<select name="civilite" id="civilite">
						<option selected value="mr">Mr</option>
						<option value="mme">Mme</option>
					</select>
				<?php
				}
				elseif ($getCivilite[0][0] == 0) 
				{?>
					<select name="civilite" id="civilite">
						<option value="mr">Mr</option>
						<option selected value="mme">Mme</option>
					</select>
				<?php
				}
				?>

					<input type="text" name="prenom" id="prenomProfil" placeholder="<?php echo $infoUser[0][3];  ?>">

					<input type="text" name="nom" id="nomProfil" placeholder="<?php echo $infoUser[0][2];  ?>">
					<br>
					<br>

					<input type="email" name="mail" id="mailProfil" placeholder="<?php echo $infoUser[0][5];  ?>">
					<br>
					<br>

					<input type="tel" name="tel" id="telProfil" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" placeholder="<?php echo $infoUser[0][6];  ?>">
					<br>
					<br>

					<input type="submit" name="update" value="MODIFIER">
				</form>
				<?php
				if (isset($_POST["update"])) 
				{
					if ($_POST["civilite"] == "mr") 
					{
						$civilite = 1;
					}
					elseif ($_POST["civilite"] == "mme") 
					{
						$civilite = 0;
					}

					$prenom = htmlspecialchars($_POST["prenom"]);
					$nom = htmlspecialchars($_POST["nom"]);
					$mail = htmlspecialchars($_POST["mail"]);
					$tel = htmlspecialchars($_POST["tel"]);

					$user->updateInfo($civilite, $prenom, $nom, $mail, $tel, $bdd);
				}

				?>



				<p>MODIFIER LE MOT DE PASSE</p>
				<form method="post" action="" id="formPassword">
					<label for="oldPassword">MOT DE PASSE ACTUEL*</label>
					<input type="password" name="oldPassword" id="oldPassword">
					<br>
					<br>

					<label for="newPassword">NOUVEAU MOT DE PASSE*</label>
					<input type="password" pattern="{6,}" name="newPassword" id="newPassword">
					<p id="infoNewPassword">Au moins 6 caractères</p>
					<br>
					<br>

					<label for="confirmNewPassword">CONFIRMER LE NOUVEAU MOT DE PASSE*</label>
					<input type="password" name="confirmNewPassword" id="confirmNewPassword">
					<br>
					<br>

					<input type="submit" name="changePassword" id="changePassword" value="Changer">
				</form>
				<?php
				if (isset($_POST["changePassword"])) 
				{
					$oldPassword = htmlspecialchars($_POST["oldPassword"]);
					$newPassword = htmlspecialchars($_POST["newPassword"]);
					$confirmNewPassword = htmlspecialchars($_POST["confirmNewPassword"]);

					$user->updatePassword($oldPassword, $newPassword, $confirmNewPassword, $bdd);
				}

				?>
			</section>
			<br>

			<section id="myPaiementAndCommande">
				<div id="myPaiement">
					MES MOYEN DE PAEIMENTS
				</div>
				<br>
				<div id="myCommande">
					MES COMMANDES
				</div>
			</section>
		</section>

		

		<br>
		<br>
		
		<section id="preferenceUser">
			<?php
			$getIdPreference = $bdd->execute("SELECT id_utilisateur FROM preference_user WHERE id_utilisateur = '$id' ");
			if (empty($getIdPreference)) 
				{?>	
					<form method="post" action="">

						-Proteines :<br />
						<section id="proteines">

							<div class="choice" id="boeuf">
								<input id="boeuf" type="checkbox" name="boeuf" value="boeuf" />
								<label for="boeuf">Boeuf</label>
							</div>

							<div class="choice" id="poulet">
								<input id="poulet" type="checkbox" name="poulet" value="poulet" />
								<label for="poulet">Poulet</label>
							</div>


							<div class="choice" id="dinde">    
								<input id="dinde" type="checkbox" name="dinde" value="dinde" />
								<label for="dinde">Dinde</label>
							</div>

							<div class="choice" id="saumon">
								<input id="saumon" type="checkbox" name="saumon" value="saumon" />
								<label for="saumon">Saumon</label>
							</div>

							<div class="choice" id="thon">
								<input id="thon" type="checkbox" name="thon" value="thon" />
								<label for="thon">Thon</label>
							</div>


							<div class="choice" id="calamar">    
								<input id="calamar" type="checkbox" name="calamar" value="calamar" />
								<label for="calamar">Calamar</label>
							</div>

						</section>


						-Légumes : 
						<section id="legumes">
							<div class="choice" id="haricots">
								<input id="haricots" type="checkbox" name="haricots" value="haricots" />
								<label for="haricots">Haricots Vert/Rouge</label>
							</div>

							<div class="choice" id="pommeDeTerre">
								<input id="pommeDeTerre" type="checkbox" name="pommeDeTerre" value="pommeDeTerre" />
								<label for="pommeDeTerre">Pomme de terre</label>
							</div>


							<div class="choice" id="brocolis">    
								<input id="brocolis" type="checkbox" name="brocolis" value="brocolis" />
								<label for="brocolis">Brocolis</label>
							</div>

							<div class="choice" id="avocat">
								<input id="avocat" type="checkbox" name="avocat" value="avocat" />
								<label for="avocat">Avocat</label>
							</div>

							<div class="choice" id="choux">
								<input id="choux" type="checkbox" name="choux" value="choux" />
								<label for="choux">Choux</label>
							</div>


							<div class="choice" id="salade">    
								<input id="salade" type="checkbox" name="salade" value="salade" />
								<label for="salade">Salade</label>
							</div>

							<div class="choice" id="poivrons">
								<input id="poivrons" type="checkbox" name="poivrons" value="poivrons" />
								<label for="poivrons">Poivrons</label>
							</div>

							<div class="choice" id="champignons">
								<input id="champignons" type="checkbox" name="champignons" value="champignons" />
								<label for="champignons">Champignon</label>
							</div>

							<div class="choice" id="lentilles">
								<input id="lentilles" type="checkbox" name="lentilles" value="lentilles" />
								<label for="lentilles">Lentilles</label>
							</div>
						</section>
						<input type="submit" name="addPreference" value="Ajouter">
					</form>
					<?php
					if (isset($_POST["addPreference"])) 
					{
						if (isset($_POST["boeuf"])) 
						{
							$boeuf = $_POST["boeuf"] ;
							$boeuf = 1;
						}
						else
						{
							$boeuf = 0 ;
						}

						if (isset($_POST["poulet"]))
						{
							$poulet = $_POST["poulet"] ;
							$poulet = 1;
						}
						else
						{
							$poulet = 0 ;
						}

						if (isset($_POST["dinde"])) 
						{
							$dinde = $_POST["dinde"] ;
							$dinde = 1;

						}
						else
						{
							$dinde = 0 ;
						}

						if (isset($_POST["saumon"])) 
						{
							$saumon = $_POST["saumon"] ;
							$saumon = 1;
						}
						else
						{
							$saumon = 0 ;
						}

						if (isset($_POST["thon"]))
						{
							$thon = $_POST["thon"] ;
							$thon = 1;
						}
						else
						{
							$thon = 0 ;
						}

						if (isset($_POST["calamar"]))
						{
							$calamar = $_POST["calamar"] ;
							$calamar = 1;
						}
						else
						{
							$calamar = 0 ;
						}

						if (isset($_POST["haricots"])) 
						{
							$haricots = $_POST["haricots"] ;
							$haricots = 1;
						}
						else
						{
							$haricots = 0 ;
						}

						if (isset($_POST["pommeDeTerre"]))
						{
							$pommeDeTerre = $_POST["pommeDeTerre"] ;
							$pommeDeTerre = 1;
						}
						else
						{
							$pommeDeTerre = 0 ;
						}

						if (isset($_POST["brocolis"]))
						{
							$brocolis = $_POST["brocolis"] ;
							$brocolis = 1;
						}
						else
						{
							$brocolis = 0 ;
						}

						if (isset($_POST["avocat"])) 
						{
							$avocat = $_POST["avocat"] ;
							$avocat = 1;
						}
						else
						{
							$avocat = 0 ;
						}

						if (isset($_POST["choux"]))
						{
							$choux = $_POST["choux"] ;
							$choux = 1;
						}
						else
						{
							$choux = 0 ;
						}

						if (isset($_POST["salade"]))
						{
							$salade = $_POST["salade"] ;
							$salade = 1;
						}
						else
						{
							$salade = 0 ;
						}

						if (isset($_POST["poivrons"]))
						{
							$poivrons = $_POST["poivrons"] ;
							$poivrons = 1;
						}
						else
						{
							$poivrons = 0 ;
						}

						if (isset($_POST["champignons"]))
						{
							$champignons = $_POST["champignons"] ;
							$champignons = 1;
						}
						else
						{
							$champignons = 0 ;
						}

						if (isset($_POST["lentilles"]))
						{
							$lentilles = $_POST["lentilles"] ;
							$lentilles = 1;
						}
						else
						{
							$lentilles = 0 ;
						}


						$user->preferenceUser($id, $boeuf, $poulet, $dinde, $saumon, $thon, $calamar, $haricots, $pommeDeTerre, $brocolis, $avocat, $choux, $salade, $poivrons, $champignons, $lentilles, $bdd);
					}
					?>
					<?php
				}
				else
				{
					echo "preferenceUser";
				}

				?>

			</section>
	</main>
</body>	
</html>