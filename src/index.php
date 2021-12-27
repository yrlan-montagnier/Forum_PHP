<?php
include('./authentification/server.php');

// Affichage des boutons connexion et déconnexion + message pour informer l'utilisateur s'il est connecté ou non
if(!empty($_SESSION['username'])){
	echo "Information de session --> ";
	echo "Vous êtes connecté en tant que ".'"'.$_SESSION['username'].'"';
	$conn = "";
	$deco = "Déconnexion";
	$display = "";
	$register = "";
	$profil = "Profil";
	$newThread = "Créer un article";
	if($_SESSION['username'] == 'admin') {
		$admin = 'Administration';
	} else {
		$admin = '';
	}
} else {
	echo "Information de connexion --> ";
	echo "Vous n'êtes pas connectés !";
	$conn = "Connexion";
	$deco = "";
	$display = "display: none;";
	$register = "Inscription";
	$profil = '';
	$newThread = "";
	$admin = '';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Forum PHP</title>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="./css/index.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<h1 style="text-align:center; color:white">Forum PHP - Mathis, Yrlan et Paul-Antoine</h1>
	<hr>
	<!-- Boutons -->
	<div style="background-color: white;">
		<a id="button-index"  style="margin-left:300px"href="./authentification/register.php"><?php echo $register; ?></a>
		<a id="button-index" href="./authentification/login.php"><?php echo $conn; ?></a>
		<a id="button-index" href="./articles/create_post.php"><?php echo $newThread; ?></a>
		<a id="button-index" href="./authentification/profile.php"><?php echo $profil; ?></a>
		<a id="button-index" href="./authentification/deconnect.php"><?php echo $deco; ?></a>
		<a id="button-index" href="./authentification/admin.php"><?php echo $admin; ?></a>
	</div>


	<hr>
	<!-- Articles -->
    <h1 style="text-align: center; color:white">Articles</h1>
	<hr><br>
	<div class="card" style="text-align: center; width:1000px; margin: 0 auto;">
	<div class="card-body" style="position: center">
		<?php
			$query = mysqli_query($db, "SELECT * FROM `articles` ORDER BY Date DESC");
			if (mysqli_num_rows($query) > 0) {
				while ($row = mysqli_fetch_array($query)) {
					$content = $row['Contenu'];
					$date = $row['Date'];
					$auteur = $row['Username'];
					$id = $row['Id'];
					$actualTitle = $row['Titre'];
					if (strlen($content) > 100) {
						$a = $content;
						$content = '';
						for($i=0;$i<100;$i++) {
							$content .= $a[$i];
						}
					}
					echo '<form method="POST" class="card-body"> <tr><td>'.'<h7> Auteur : '.$auteur.' - '.$date.'</h7></td><td>'.' <br><h5> Titre : '.$row["Titre"].' </h5><br> Contenu du post : '.$content.' <br><br>  '.' </td></tr><hr>';
				}
			} else{
				echo '<tr><td>Aucun sujet trouvé ! :(</tr></td>';
			}
		?>
		</div>
	</div>
</body>
</html>