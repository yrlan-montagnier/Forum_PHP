<?php
include('./authentification/server.php');

// Affichage des boutons connexion et déconnexion + message si l'utilisateur est connecté
if(!empty($_SESSION['username'])){
	echo "Connecté en tant que ".$_SESSION['username'];
	$conn = "";
	$deco = "Déconnexion";
	$display = "";
	$register = "";
} else {
	$conn = "Connexion";
	$deco = "";
	$display = "display: none;";
	$register = "Inscription";
}

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Forum PHP</title>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
<body>
	<h1>Forum PHP</h1>
	<!-- Boutons -->
	<a href="./authentification/register.php"><?php echo $register; ?></a>
    <a href="./authentification/login.php"><?php echo $conn; ?></a>
	<a href="./authentification/deconnect.php"><?php echo $deco; ?></a>
	<!-- Sujets -->
    <h1>Threads:</h1>
	<!-- Nouveau sujet -->
	<h2>Créer un sujet:</h1>
	<a href="./articles/create_post.php">Créer</a>
	<!-- Liste des sujets -->
	<h2>Liste des sujets:</h1>
    <table>
        <tbody>
			<h3>Utilisateur : <?php echo $articleUser?> Titre : <?php echo $articleTitle?> </h3>
		</tbody>
    </table>
	
</body>
</html>