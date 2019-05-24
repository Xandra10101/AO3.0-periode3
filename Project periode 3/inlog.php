<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
include "./connection_database.php";
$username = $password = "";
$username_err = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["username"]))){
    $username_err = "Vul je username in aub.";
  }else{
    $username = trim($_POST["username"]);
  }
  if(empty(trim($_POST["password"]))){
    $password_err = "Vul je wachtwoord in aub.";
  }else{
    $password = trim($_POST["password"]);
  }
  if(empty($username_err) && empty($password_err)){
    $sql = "SELECT ID, Username, Password FROM users WHERE Username = :username";
    if($stmt = $pdo->prepare($sql)){
      $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
      $param_username = trim($_POST["username"]);
      if($stmt->execute()){
        if($stmt->rowCount() == 1){
          if($row = $stmt->fetch()){
            $id = $row["ID"];
            $username = $row["username"];
            $hashed_password = $row["password"];
            if(password_verify($password, $hashed_password)){
              session_start();
              $_SESSION["loggedin"] = true;
              $_SESSION["ID"] = $id;
              $_SESSION["username"] = $username;
              header("location: welcome.php");
            }else{
              $password_err = "Verkeerd wachtwoord ingevoerd";
            }
          }
        }else{
          $username_err = "er is geen account gevonden met deze username";
        }
      }else{
        echo "Oeps. Iets ging verkeerd probeer later opnieuw";
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
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href="./View/css/project_styles.css"/>
  <title>Forum AO3.0</title>
  </head>
  <body>
  	<h1>Forum Alfa-college</h1>
  	<nav>
      <a href="./inlog.php">Inloggen</a>
      <a href="./register.php">Registreer</a>
      <a href="#">Creër een onderwerp</a>
      <a href="#">Creër een categorie</a>
  	</nav>
  	<form method="post" action="index.php">
  		<fieldset>
  			<legend>Log hier in</legend>
  			<input required="text" id="username" placeholder="Username">
  			<input type="password" id="password" placeholder="Password">
  			<input type="submit" name="send" id="send" value="Log in">
  		</fieldset>

  	</form>

  </body>
</html>
