<?php
include "./connection_database.php";
$username = $password = $confirm_password = $studentnumber = $email = $name = "";
$username_err = $password_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["username"]))){
    $username_err = "Vul een gebruikersnaam aub.";
  }else{
    $sql = "SELECT ID FROM users WHERE Username = :username";
    if($stmt = $pdo->prepare($sql)){
      $stmt->bindParam(":Username", $param_username, PDO::PARAM_STR);
      $param_username = trim($_POST["username"]);
      if($stmt->execute(array(":username"=>$username))){
        if($stmt->rowCount() == 1){
          $username_err = "Deze gebruikersnaam is al in gebruik"; 
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
  }elseif(strlen(trim($_POST["password"])) < 7 && strlen(trim($_POST["password"])) > 50){
    $password_err = "Het wachtwoord moet tussen de 7 en 50 tekens bevatten";
  }else{
    $password = trim($_POST["password"]);
  }
  if(empty(trim($_POST["password"]))){
    $confirm_password_err = "Bevestigt het wachtwoord aub.";
  }else{
    $confirm_password = trim($_POST["password"]);
    if(empty($password_err) && ($password != $confirm_password)){
      $confirm_password_err = "De wachtwoorden komen niet overeen";
    }
  }
  if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
    $sql = "INSERT INTO users (username, password, name, email, studentnumber) VALUES (:Username, :Password, :Name, :Email, :Studentnumber)";
    if($stmt = $pdo->prepare($sql)){
      $stmt->bindParam(":Username", $param_username, PDO::PARAM_STR);
      $stmt->bindParam(":Password", $param_password, PDO::PARAM_STR);
      $stmt->bindParam(":Studentnumber", $param_studentnumber, PDO::PARAM_STR);
      $stmt->bindParam(":Email", $param_email, PDO::PARAM_STR);
      $stmt->bindParam(":Name", $param_name, PDO::PARAM_STR);
      $param_username = $username;
      $param_studentnumber = $studentnumber;
      $param_email = $email;
      $param_name = $name;
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
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <fieldset>
        <legend>Registeren</legend>
        <input required="text" id="Name" name="Name" placeholder="Last and first name">
        <input type="text" id="email" name="email" placeholder="E-mail">
        <input type="text" id="studentnumber" name="studentnumber" placeholder="Studentnumber">
        <input required="text" id="username" name="username" placeholder="Username">
        <input type="password" id="password" name="password"placeholder="Password">
        <input type="password" id="password" name="password" placeholder="Password again">
        <input type="submit" name="submit" id="submit" value="Register">
      </fieldset>
    </form>
  </body>
</html>
