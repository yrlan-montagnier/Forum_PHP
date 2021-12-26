<?php include('server.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Page d'inscription</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<a href="../index.php">Retourner à l'accueil</a>
	<div class="header">
		<h2>S'inscrire</h2>
	</div>
	
	<form method="post" action="register.php">
	<!-- Nom d'utilisateur -->
  	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
	<!-- Mail -->
  	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
	<!-- Mot de passe -->
  	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1">
  	</div>
	<!-- Mot de passe, confirmation -->
  	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
  	</div>
	<!-- Bouton d'inscription -->
  	<div class="input-group">
		<button type="submit" class="btn" name="reg_user">S'inscrire</button>
  	</div>
	<!-- Redirection vers la page login -->
  	<p>
		Vous avez déja un compte? <a href="login.php">Se connecter !</a>
  	</p>
  	</form>
</body>
</html>