<?php


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<main>
		<section id="showPlat" >
			<form method="post" action="">
				<div id="divAddPlat">
					<button id="showDiv">RETOUR</button>
					<p>Ajout plat & catégorie</p>
				</div>
				<hr>
				<section id="addPlatAndCategorie">
					<div id="fullFormPlat">
						Ajouter un plat
						<br>
						<br>

						<div id="formAddPlat">
							<label for="namePlat">Nom</label>
							<br>
							<input type="text" name="namePlat">
							<br>
							<br>

							<label for="imgPlat">Image</label>
							<br>
							<input type="file" name="imgPlat">
							<br>
							<br>

							<label for="descriptionPlat">Description</label>
							<br>
							<textarea id="descriptionPlat" name="descriptionPlat" rows="8" cols="25"></textarea>
							<br>
							<br>

							<label for="prixPlat">Prix</label>
							<br>
							<input type="number" name="prixPlat">
							<br>
							<br>

							<select>
								<option>CATEGORIE 1</option>
								<option>CATEGORIE 2</option>
							</select>
							<br>
							<br>

							<input type="submit" name="addPlat" value="Ajouter">
						</div>
					</div>

					<div id="verticalLinePlatAndCategorie"></div>

					<div id="fullFormCategorie">
						Ajouter une categorie
						<br>
						<br>
						<div id="formAddCategorie">
							<label for="nameCategorie">Nom</label> 
							<br>
							<input type="text" name="nameCategorie">
							<br>
							<br>

							<input type="submit" name="addCategorie" value="Ajouter">
						</div>
					</div>
				</section>
			</form>
		</section>
		<?php 
		if (isset$_POST["addPlat"]) 
		{
			$namePlat = htmlspecialchars($_POST["namePlat"]);
			$descriptionPlat = htmlspecialchars($_POST["descriptionPlat"]);
			
		}
		?>
	</main>

</body>
</html>