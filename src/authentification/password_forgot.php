<?php
include('../authentification/server.php');
if (!isset($_POST["submit"])) { ?>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
   Votre adresse e-mail: <input type="text" name="to_email"><br>
   <input type="submit" name="submit" value="Envoyer l'E-mail">
  </form>
<?php
} else {
 
  if (isset($_POST["to_email"])) {
    $to_email = $_POST["to_email"];
    $from_email = "Forum.php@help-center.com";
    $subject = "Réinitialisation de votre mot de passe ForumPHP";
    $body = "Bonjour, une demande de réinitialisation de mot de passe a été effectuée sur notre site, si vous souhaitez le modifier, veuillez suivre ce lien: ";
    $query = mysqli_query($db, "SELECT Mail FROM `users`");
    $user_list = mysqli_fetch_assoc($query);
    $user_in_list = $user_list[$to_email];

    if ($user_in_list) {
        if ( mail($to_email, $subject, $body, $from_email)) {
        echo("E-mail envoyé à $to_email...");
        } else {
        echo("envoi de l'E-mail échoué...");
        }
    } else {
        echo "Adresse mail non répertoriée sur le site.";
    }
  }
}
?>