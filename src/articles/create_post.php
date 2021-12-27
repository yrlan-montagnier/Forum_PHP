<?php
	include('../authentification/server.php');
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
        <meta charset="UTF-8" />
		<link rel="stylesheet" href="../css/login.css" media="screen" type="text/css" />
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<!-- Bouton de retour à l'accueil -->
		<a href="../index.php"> Retourner à l'accueil </a>
		<h1>Créer un sujet :</h1>
		<form action='create_post.php' method='POST'>
		<table>
			<tbody>
				<tr>
					<td>Title: </td><td><input type='text' name='title' /></td>
				</tr>
				<tr>
					<td>Description: </td><td><input type='text' name='description' /></td>
				</tr>
				<tr>
					<td></td><td><input type='submit' value='Create Thread' name='createThread' /></td>
				</tr>
			</tbody>
		</table>
		<?php
		echo $disconnected;
		echo $connexion;
		?>
		</form>
	</body>
</html>
