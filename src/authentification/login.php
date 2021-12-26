<?php include('server.php') ?>  

<html>
    <head>
        <title>Connexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/login.css" media="screen" type="text/css" />
    </head>
    <body>
    <!-- Bouton de retour à l'accueil -->
    <a href="../index.php"> Retourner à l'accueil </a>

        <div id="container">
            <!-- Zone de connexion -->
            <!-- Quand on valide le formulaire, on va vérifier si l'user existe dans la DB à l'aide de notre fichier 'login_verif.php' -->
            <form action="login_verif.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='LOGIN' >

                <!-- Redirection vers la page login -->
                <p> Vous n'êtes pas inscrits? <a href="register.php">S'inscrire !</a></p>
                <a href="password_forgot.php"> Mot de passe oublié ?</a>

                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>

            </form>
        </div>
    </body>
</html>
