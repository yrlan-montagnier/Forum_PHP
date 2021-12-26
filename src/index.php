<?php
include('./authentification/server.php');

// Affichage des boutons connexion et déconnexion + message pour informer l'utilisateur s'il est connecté ou non
if(!empty($_SESSION['username'])){
	echo "Information de connexion --> ";
	echo "Vous êtes connecté en tant que ".'"'.$_SESSION['username'].'"';
	$conn = "";
	$deco = "Déconnexion";
	$display = "";
	$register = "";
	$profil = "Profil";
} else {
	echo "Information de connexion --> ";
	echo "Vous n'êtes pas connectés !";
	$conn = "Connexion";
	$deco = "";
	$display = "display: none;";
	$register = "Inscription";
	$profil = '';
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Forum PHP</title>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
	<h1>Forum PHP - Mathis, Yrlan et Paul-Antoine</h1>
	<!-- Boutons -->
	<a href="./authentification/register.php"><?php echo $register; ?></a>
    <a href="./authentification/login.php"><?php echo $conn; ?></a>
	<a href="./authentification/deconnect.php"><?php echo $deco; ?></a>
	<a href="./authentification/profile.php"><?php echo $profil; ?></a>
	<!-- Articles -->
    <h1>Articles</h1>
	<!-- Nouvel article -->
	<h2>Créer un article :</h1>
	<a href="./articles/create_post.php">Créer</a>
	<!-- Liste des articles -->
	<h2>Liste des articles :</h1>
    <table>
        <tbody>
		<?php
			$query = mysqli_query($db, "SELECT * FROM `articles` ORDER BY Date DESC");
			if (mysqli_num_rows($query) > 0) {
				while ($row = mysqli_fetch_array($query)) {
					$content = $row['Contenu'];
					$date = $row['Date'];
					$auteur = $row['Username'];
					$id = $row['Id'];
					if (strlen($content) > 100) {
						$a = $content;
						$content = '';
						for($i=0;$i<100;$i++) {
							$content .= $a[$i];
						}
					}
					echo '<tr><td>'.'Auteur : '.$auteur.' | Titre : '.$row["Titre"].' | Date du sujet : '.$date.'</td><td>'.' | Contenu du post : '.$content.'<form method="POST"> <button name="modifier">Modifier</button> '.'<form method="POST"><button name="supprimer">Supprimer</button></form>'.' </td></tr>';
					if (isset($_POST['supprimer'])) {
						$query = mysqli_query($db, "DELETE FROM `articles` WHERE Id = .$id.");
					}
				}
			} else{
				echo '<tr><td>Aucun sujets trouvés ! :(</tr></td>';
			}
		?>
		</tbody>
    </table>
	
</body>
</html>