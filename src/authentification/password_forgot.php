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
    $headers = "From: Forum.php@help-center.com";
    $subject = "Réinitialisation de votre mot de passe ForumPHP";
    $body = "Bonjour, une demande de réinitialisation de mot de passe a été effectuée sur notre site, si vous souhaitez le modifier, veuillez suivre ce lien: ";
    $query = mysqli_query($db, "SELECT Mail FROM `users` WHERE Mail='$to_email'");
    echo $to_email;

    if ($query) {
        mail($to_email, $subject, $body, $headers);
        echo("E-mail envoyé à $to_email...");
    } else {
        echo "Adresse mail non répertoriée sur le site.";
    }
  }
}
?>