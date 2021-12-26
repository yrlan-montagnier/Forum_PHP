<?php 
include('server.php');

$userEmail = '';
$userPasswd = '';
$userName = '';
$error = '';

$sessionName = $_SESSION['username'];
$query = mysqli_query($db, "SELECT * FROM users WHERE Username = '".$sessionName."'");
$user = mysqli_fetch_array($query);
$userEmail = $user['Mail'];
$userPasswd = $user['Password'];
$userName = $user['Username'];

if (isset($_POST['edit'])) {
  $newUser = mysqli_real_escape_string($db, $_POST['Pseudo_2']);
  $newEmail = mysqli_real_escape_string($db, $_POST['Email_2']);
  $newPass1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $newPass2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $updatedPass = md5($newPass1);

  if (!empty($newUser)) {
    $db->query("UPDATE users SET Username = '".$newUser."' WHERE Username = '".$sessionName."'");
    $_SESSION['username'] = $newUser;
    header('Location:profile.php');
  }

  if (!empty($newEmail)) {
    $db->query("UPDATE users SET Mail = '".$newEmail."' WHERE Username = '".$sessionName."'");
    header('Location:profile.php');
  }

  if (!empty($newPass1 && !empty($newPass2))) {
    if ($newPass1 != $newPass2) {
      echo "Les mots de passe doivent correspondre.";
    }

    if ($newPass1 == $userPasswd) {
      echo "Votre mot de passe ne doit pas être le même que l'ancien.";
    }  
  
    if ($newPass1 == $newPass2) {
      $db->query("UPDATE users SET Password = '".$updatedPass."' WHERE Username = '".$sessionName."'");
      header('Location:profile.php');
    }
  }
  if ($sessionName == 'admin') {
    $pfp = "../img/pfp2.png";
  } else $pfp = "../img/pfp.png";
} 

?>

<html>
  <head>
    <title>Profil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/login.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="text-align:center; position:center;">
    <!-- Redirection à l'accueil -->
    <a href="../index.php" style="background-color: white;">Retourner à l'accueil</a>
    <div class="card" style="width: 18rem; margin-left:620px;">
      <img class="card-img-top" src=<?php $pfp ?> alt="Image de profil">
      <div class="card-body">
        <h5 class="card-title">Votre Profil</h5>
        <p class="card-text">Vous pouvez consulter et modifier vos informations de compte dans cette section</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Pseudo: <?php echo $userName ?></li>
        <li class="list-group-item">E-mail: <?php echo $userEmail ?></li>
      </ul>
      <div class="card-body">
        <form method="post" action="profile.php">
          <input type="text" placeholder="Nouveau pseudo" name="Pseudo_2">
          <input type="text" placeholder="Nouvelle adresse Mail" name="Email_2">
          <input type="password" placeholder="Nouveau mot de passe" name="password_1">
          <input type="password" placeholder="Confirmez votre mot de passe" name="password_2">
          <button type="submit" name="edit">Modifier</button>
        </form>
      </div>
      <?php echo $error?>
    </div><br><br>
    <h2 style="text-align: center; color:white"> Vos posts </h2>
    <hr>
    <div style="margin-left:200px; margin-right:200px">
      <?php
      $sessionUser = $_SESSION['username'];
        $query = mysqli_query($db, "SELECT * FROM `articles` WHERE Username = '$sessionUser' ORDER BY Date DESC");
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
            echo '<form method="POST"> <tr><td>'.'Auteur : '.$auteur.' - '.$date.'</td><td>'.' <br> Titre : '.$row["Titre"].' <br> Contenu du post : '.$content.' <br> <button name="modifier">Modifier</button> '.'<form method="POST"><button name="supprimer">Supprimer</button></form>'.' </td></tr>';
            if (isset($_POST['supprimer'])) {
              $query = mysqli_query($db, "DELETE FROM `articles` WHERE Id = .$id.");
            }
          }
        } else{
          echo '<tr><td>Aucun sujets trouvés ! :(</tr></td>';
        }
      ?>
      </div>
  </body>
</html>