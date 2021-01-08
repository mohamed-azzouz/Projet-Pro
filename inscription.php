<?php
session_start();

require 'class/bdd.php';
require 'class/user.php';

$user = new user();
$bdd = new bdd();

$bdd->connect();


if (isset($_SESSION['id'])) 
{
	header('Location:connexion.php');
}
?>

<!DOCTYPE html>
<html> 
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="bodyInscription">
	<main id="mainInscription">
		<div id="titleInscription">CREEZ VOTRE COMPTE</div>
		<hr>
		
		<section id="containerInscription">
			<form method="post" action="" id="formulaireInscription">
				
				<section id="fullFormInscription">
					<div id="leftSideFrom">
						

						<select name="civilite" id="civilite" required>
							<option>Civilité *</option>
							<option value="mr">Mr</option>
							<option value="mme">Mme</option>
						</select>
						<br>
						<br>
						<input type="text" name="prenom" id="prenomInscription" placeholder="Prénom *" required>
						<br>
						<br>
						<input type="text" name="nom" id="nomInscription" placeholder="Nom *" required>
						<br>
						<br>
						<input type="email" name="mail" id="mailInscription" placeholder="Adresse mail *" required>
						

					</div>

					<div id="verticalLineInscription"></div>

					<div id="rightSideForm">

						
						<input type="tel" name="tel" id="telInscription" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" placeholder="N° Télephone *" required>
						<br>
						<br>

						<input type="password" name="mdp" id="mdpInscription" pattern="{6,}" placeholder="Mot de passe *" required>
						<p id="infoPassword">Au moins 6 caractères</p>
						<br>

						<input type="password" name="confirmMdp" id="confirmMdpInscription" placeholder="Confirmer le mot de passe *" required>
						<br>
						<br>

						
						<input type="submit" name="send" value="Valider">
						<input type="submit" name="back" value="Retour">

					</div>

					
				</section>
			</form>

		</section>
		<?php
		if (isset($_POST["back"])) 
		{
			header('Location:connexion.php');
		}
		elseif (isset($_POST["send"])) 
		{
			if ($_POST["civilite"] == "mr") 
			{
				$civilite = 1;
			}
			elseif ($_POST["civilite"] == "mme") 
			{
				$civilite = 0;
			}
			else
			{
				echo "Veuiller choisir votre civilité";
			}

			$prenom = htmlspecialchars($_POST["prenom"]);
			$nom = htmlspecialchars($_POST["nom"]);
			$mail = htmlspecialchars($_POST["mail"]);
			$tel = htmlspecialchars($_POST["tel"]);
			$mdp = htmlspecialchars($_POST["mdp"]);
			$confirmMdp = htmlspecialchars($_POST["confirmMdp"]);


			$user->inscription($civilite, $prenom, $nom, $mail, $tel, $mdp, $confirmMdp, $bdd);
			
		}
		?>
	</main>

</body>
</html>