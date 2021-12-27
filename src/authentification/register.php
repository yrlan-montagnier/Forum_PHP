<?php include('server.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Page d'inscription</title>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
</head>

<body>
	<!-- Redirection à l'accueil -->
	<a href="../index.php">Retourner à l'accueil</a>
	<div class="header">
		<h2>S'inscrire</h2>
	</div>
	
	<form method="post" action="register.php">
	<!-- Nom d'utilisateur -->
  	<div class="input-group">
		<label>Nom d'utilisateur :</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
	<!-- Mail -->
  	<div class="input-group">
		<label>Email :<br></label>
		<input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
	<!-- Mot de passe -->
  	<div class="input-group">
		<label>Mot de passe :</label>
		<input type="password" name="password_1">
  	</div>
	<!-- Mot de passe, confirmation -->
  	<div class="input-group">
		<label>Confirmez le mot de passe :</label>
		<input type="password" name="password_2">
  	</div>
	<!-- Bouton d'inscription -->
  	<div class="input-group">
		<button type="submit" class="btn" name="reg_user">Inscription</button>
		<!-- Redirection vers la page login -->
		<p>Vous avez déja un compte? : <a href="login.php">Se connecter !</a> </p>
  	</form>
	<!-- Redirection vers la page login -->
	<p> Vous n'êtes pas inscrits? <a href="register.php">S'inscrire !</a></p>
	<a href="password_forgot.php"> Mot de passe oublié ?</a>
  	</div>

</body>
</html>