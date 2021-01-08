<?php
session_start();

require 'class/bdd.php';
require 'class/user.php';

$user = new user();
$bdd = new bdd();

$bdd->connect();



?>



<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="bodyConnexion">
	<main id="mainConnexion">
		<section id="fullFormConnexion">
			<section id="titleConnexion">
				<div>
					<hr width="100">
					IDENTIFIEZ-VOUS OU CREEZ VOTRE COMPTE
					<hr width="100">
				</div>
			</section>
			<section id="formConnexion">
				
				<div id="formulaire">
					<p>JE SUIS DEJA CLIENT</p>
					<form method="post" action=""> 
						<label for="mail">Adresse e-mail :</label>
						<br>
						<input type="email" name="mail" id="mailConnexion" required>

						<br>
						<label for="mdp">Mot de passe :</label>
						<br>
						<input type="password" name="mdp" id="mdpConnexion" required>
						
						<br>
						<br>
						<input type="submit" name="connexion" value="Connexion">
						
						<br>
						<a href="">Mot de passe oublié ? </a>
					</form>
				</div>
			
				<div id="goToInscription">
						<p>JE M'INSCRIS</p>
					<form method="post" action="">
						<input type="submit" name="inscription" value="CREEZ VOTRE COMPTE">
					</form>
				</div>
			</section>
		</section>
		<?php
		if (isset($_POST["connexion"])) 
		{
			$mail = htmlspecialchars($_POST["mail"]);
			$password = htmlspecialchars($_POST["mdp"]);

			$user->connexion($mail, $password, $bdd);
		}
		if (isset($_POST["inscription"])) 
		{
			header('Location:inscription.php');
		}

		?>
	</main>

</body>
</html>