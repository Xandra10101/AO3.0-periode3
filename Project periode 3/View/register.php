<?php
require_once "connection_database.php";
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["username"]))){
    $username_err = "Vul een gebruikersnaam aub.";
  }else{
    $sql = "SELECT id FROM users WHERE username = :Username";
    if($stmt = $pdo->prepare($sql)){
      $stmt->biindParam(":Username", $param_username, PDO::PARAM_STR);
      $param_username = trim($_POST["username"]);
      if($stmt->execute()){
        if($stmt->rowCount() == 1){
          $username_err = "Deze gebruikersnaam is al in gebruikt"; 
        }else{
          $username = trim($_POST["username"]);
        }
      }else{
        echo "Oeps. Iets ging verkeerd. Probeer opnieuw later"; 
      }
    }
    unset($stmt);
  }
  if(empty(trim($_POST["password"]))){
    $password_err = "Voer een wachtwoord in aub.";
  }elseif(strlen(trim($_POST["password"])) < 7){
    $password_err = "Het wachtwoord moet meer dan 7 tekens bevatten";
  }else{
    $password = trim($_POST["password"]);
  }
  if(empty(trim($_POST["confirm_password"]))){
    $confirm_password_err = "Bevestigt het wachtwoord aub.";
  }else{
    $confirm_password = trim($_POST["confirm_password"]);
    if(empty($password_err) && ($password != $confirm_password)){
      $confirm_password_err = "De wachtwoorden komen niet overeen";
    }
  }
  if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
    $sql = "INSERT INTO users (Username, password) VALUES (:Username, :Password)";
    if($stmt = $pdo->prepare($sql)){
      $stmt->bindParam(":Username", $param_username, PDO::PARAM_STR);
      $stmt->bindParam(":Password", $param_password, PDO::PARAM_STR);
      $param_username = $usrename;
      $param_password = password_hash($password, PASSWORD_DEFAULT);
      if($stmt->execute()){
        header("location: inlog.php");
      }else{
        echo "Er ging iets verkeerd. Probeer opnieuw later";
      }
    }
    unset($stmt);
  }
  unset($pdo);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href="/View/css/project_styles.css"/>
  <title>Forum AO3.0</title>
  </head>
  <body>
    <h1>Forum Alfa-college</h1>
    <nav>
      <a href="inlog.php?p=login">Inloggen</a>
      <a href="register.php?p=register">Registreer</a>
      <a href="#">Creër een onderwerp</a>
      <a href="#">Creër een categorie</a>
    </nav>
      <form method="post" action="">
      <fieldset>
        <legend>Register</legend>
        <input required="text" id="Name" placeholder="Last and first name">
        <input type="text" id="email" name="email" placeholder="E-mail"> <br>
        <input type="text" id="studentnumber" name="studentnumber" placeholder="Studentnumber"> <br> 
        <input required="text" id="username" name="username" placeholder="Username"> <br>
        <input type="password" id="password" name="password"placeholder="Password"><br>
        <input type="password" id="password" name="password" placeholder="Password again"><br>
        <input type="submit" name="submit" id="submit" value="Register"><br>
      </fieldset>
    </form>
  </body>
</html>
