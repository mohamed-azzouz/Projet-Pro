<?php
session_start();

require 'class/bdd.php';
require 'class/user.php';

$user = new user();
$bdd = new bdd();

$bdd->connect();




?>

<!DOCTYPE html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/admin.js"></script>

</head>
<body id="bodyAdmin">
	<main id="mainAdmin">
		<section id="containerAdmin">
			

			<section id="divAdmin">
				<div class="button">
					<button id="showDivUser" class="showDiv">Gérer les utilisateur<br>Gérer les droits</button>
				</div>
				<fieldset id="gestionUser">
					<form method="post" action="" id="formAllUser">
						
						<table id="tableListeUser">
							<thead>
								<tr>
									<th colspan="5">Liste des utilisateur</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>Nom</td>
									<td>Prénom</td>
									<td>Rang</td>
									<td>Droits</td>
									<td></td>
								</tr>
								<?php
								$getAllUser = $bdd->execute("SELECT * FROM utilisateurs");
								$countUser = count($getAllUser);

								for ($i=0; $i < $countUser ; $i++) 
								{
									
								?>
									<tr>
										<td><?php echo $getAllUser[$i][2]; ?></td>
										<td><?php echo $getAllUser[$i][3]; ?></td>
										<?php
										if ($getAllUser[$i][8] == 1) 
										{?>
											<td>Utilisateur</td>
											<td> <input type="submit" class="inputListUser" name="levelUp<?php echo $getAllUser[$i][0];  ?>" value="+"> / <input type="submit" class="inputListUser" name="levelDown<?php echo $getAllUser[$i][0];  ?>" value="-" disabled> </td>
										<?php
										}
										else
										{?>
											<td>Admin</td>
											<td> <input type="submit" class="inputListUser" name="levelUp<?php echo $getAllUser[$i][0];  ?>" value="+" disabled> / <input type="submit" name="levelDown<?php echo $getAllUser[$i][0];  ?>" value="-"> </td>
										<?php
										}
										?>
									
										
										<td><input type="submit" class="inputListUser" name="deleteUser<?php echo $getAllUser[$i][0];  ?>" value="Supprimer"></td>
									</tr>
								<?php
									$idUser = $getAllUser[$i][0];
									
									if (isset($_POST["levelUp$idUser"])) 
									{
										$updateDroit = $bdd->executeonly("UPDATE utilisateurs SET id_droits = '10' WHERE id = '$idUser' ");
									}
									if (isset($_POST["levelDown$idUser"])) 
									{
										$updateDroit = $bdd->executeonly("UPDATE utilisateurs SET id_droits = '1' WHERE id = '$idUser' ");
									}
									if (isset($_POST["deleteUser$idUser"])) 
									{
										$deleteUser = $bdd->executeonly("DELETE FROM utilisateurs WHERE id = '$idUser' ");
									}
								}
								

								?>
								<script type="text/javascript">
									$(".inputListUser").click(function(){
										$( "#formAllUser" ).load(" #formAllUser");
									});
								</script>
							</tbody>
						</table>
					</form>
				</fieldset>

				<div class="button">
					<button type="button" id="showDivPlat" class="showDiv" onclick="marchestp()">Ajouter un plat<br>Ajouter une categorie</button>
				</div>
				<fieldset id="showPlat" style="display: none;" >
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
									<textarea id="descriptionPlat" rows="8" cols="25"></textarea>
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
				</fieldset>


				<div class="button">
					<button id="showDiv" class="showDiv">VIDE POUR LE MOMENT</button>
				</div>

				<div class="button">
					<button id="showDiv" class="showDiv">Top 5 des produits</button>
				</div>

				<div class="button">
					<button id="showDiv" class="showDiv">Gérer les commandes</button>
				</div>

				<div class="button">
					<button id="showDiv" class="showDiv">Liste des articles</button>
				</div>
			</section>

		</section>

		
		
	</main>
	
	
	
</body>
</html>