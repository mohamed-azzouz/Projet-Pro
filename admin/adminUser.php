<?php

session_start();

require '../class/bdd.php';
require '../class/user.php';

$user = new user();
$bdd = new bdd();

$bdd->connect();


?>

<!DOCTYPE html>
<html>
<head>
	<title>Gestion Utilisateurs</title>
</head>
<body>
	<main>
		<section id="gestionUser">
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
								
							</tbody>
						</table>
					</form>
				</section>
			</main>

		</body>
		</html>