<?php
include('../authentification/server.php');

if (isSet($_POST['modify'])) {
    if ($_POST['title'] == '') {
      echo "Veuillez entrer un titre";
    }
    if ($_POST['description'] == '') {
      echo "Veuillez insérer du contenu !";
    }

    if ($_POST['title'] != '') {
        $newTitle = mysqli_real_escape_string($db, $_POST['description']);
        $query = mysqli_query($db, "UPDATE articles SET Titre = '".$newTitle."'");
    }
    if ($_POST['description'] != '') {
        $newContent = mysqli_real_escape_string($db, $_POST['description']);
        $query = mysqli_query($db, "UPDATE articles SET Contenu = '".$newContent."'");
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
        <meta charset="UTF-8" />
		<link rel="stylesheet" href="./css/index.css" media="screen" type="text/css" />
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<!-- Bouton de retour à l'accueil -->
		<a href="../index.php"> Retourner à l'accueil </a>
		<h1>Editer un sujet :</h1>
		<form action='create_post.php' method='POST'>
		<table>
			<tbody>
				<tr>
					<td>
                        Titre actuel: 
                        <?php
                        echo $actualTitle;
                        ?>
                    </td>
                    <br>
					<td><input type='text' name='title' placeholder="Nouveau titre"/></td>
				</tr>
				<tr>
                    <td>Description actuelle: <?php  $description ?></td>
					<td><input type='text' name='description' placeholder="Nouvelle description" /></td><br>
				</tr>
				<tr>
					<td></td><td><input type='submit' value='Editer le sujet' name='createThread' /></td>
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
