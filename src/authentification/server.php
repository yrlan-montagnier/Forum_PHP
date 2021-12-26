<?php
session_start();

// *********************************** Initialiser les variables ***********************************

$username = "";
$email    = "";
$errors = array(); 
$connexion = '';
$disconnected = '';


// *********************************** Connexion à la base de donnée ***********************************

$db = mysqli_connect('localhost', 'root', '', 'php_exam_db');

// *********************************** Vérification utilisateur connecté ***********************************

if (!isSet($_SESSION['username'])) {
  $disconnected = "Vous n'êtes pas connecté ! \n";
  $connexion = " <a href='../authentification/login.php'>Se connecter</a>";
}

// *********************************** Inscription d'un utilisateur ***********************************

if (isset($_POST['reg_user'])) {
  // On récupère le contenu des champs remplis par l'utilisateur.
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // Vérifier si les champs sont remplis + vérif mdp confirmation
  if (empty($username) OR empty($password_1) OR empty($password_2) OR empty($email)) { 
    echo "Tous les champs ne sont pas rempli !"; 
  } elseif($password_1 != $password_2) {
    echo "Les mots de passe ne correspondent pas !"; 
  } 

  // On vérifie dans la base de données si
  // Un utilisateur existe déjà avec le même username ou mail
  $user_check_query = "SELECT * FROM users WHERE Username='$username' OR Mail='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if (!$user) { 
    if ($user['username'] === $username) {
      echo "Pseudo déjà utilisé !";
    }
    if($user['email'] === $email) {
        echo "Cet adresse mail est déjà utilisée !";
    } 
    else {
      // Pour finir, on compte le nombre d'erreurs dans le formulaires
      // Puis on inscrit l'utilisateur dans la base de données s'il n'y en a pas.
      if (count($errors) == 0) {
        // On chiffre le mot de passe avant de l'enregistrer dans la base de données
        $password = md5($password_1);
        // On prépare puis on éxécute une requète pour insèrer les champs + le pwd chiffré dans la base de données
        $query = "INSERT INTO users (Username, Password, Mail ) VALUES('$username', '$password', '$email')";
        mysqli_query($db, $query);
      
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Vous êtes maintenant connectés !";
        header('location: ../index.php');
      }
    }
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Un utilisateur est requis");
  }
  if (empty($password)) {
  	array_push($errors, "Un mot de passe est requis");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "Vous êtes maintenant connectés.";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Mauvaise combinaison username/mot de passe");
  	}
  }
}

// *********************************** Création d'un nouveau post ***********************************

if (isSet($_POST['createThread'])) {
  if ($_POST['title'] == '') {
    echo "Veuillez entrer un titre";
  }
  if ($_POST['description'] == '') {
    echo "Veuillez insérer du contenu !";
  }

  if (isSet($_POST['title']) && $_POST['title'] != '' && isSet($_POST['description']) && $_POST['description'] != '' && isSet($_SESSION['username']) && $_SESSION['username'] != '') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date =  date('d.m.Y H:i:s');
    $user = $_SESSION['username'];

    $q = mysqli_query($db, "INSERT INTO `articles` VALUES ('', '$title', '$description', '$date', '$user')") or die(mysqli_error($db));
    if ($q) { 
      echo 'Articlé crée.';
      header('location: ../index.php');
    }else
      echo 'Echec de la création de l\'article.';
  }
}
