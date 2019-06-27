<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
require_once "connection_database.php";
$username = $password = "";
$username_err = $password_err = "";
if($_SERVER['REQUEST_METHOD'] == "POST"){
  if(empty(trim($_POST["username"]))){
    $username_err = "Vul een gebruikersnaam in aub.";
  }else{
    $username = trim($_POST["username"]);
  }
  if(empty(trim($_POST["password"]))){
    $password_err = "Vul een wachtwoord in aub.";
  }else{
    $password = trim($_POST["password"]);
  }
  if(empty($username_err) && empty($password_err)){
    $sql ="SELECT id, username, password FROM users WHERE username = :Username";
    if($stmt = $pdo->prepare($sql)){
      $stmt->bindParam(":Username", $param_username, PDO::PARAM_STR);
      $param_username = trim($_POST["username"]);
      if($stmt->execute()){
        if($stmt->rowCount() == 1){
          if($row = $stmt->fetch()){
            $id = $row['ID'];
            $username = $row["username"];
            $hashed_password = $row["password"];
            if(password_verify($password, $hashed_password)){
              session_start();
              $_SESSION["loggedin"];
              $_SESSION["ID"] = $id;
              $_SESSION["username"] = $username;
              header("location: welcome.php");
            }else{
              $password_err = "Het opgegeven wachtwoord klopt niet";
            }
          }
        }else{
          $username_err = "geen account gevonden met deze gebruikersnaam";
        }
      }else{
        echo "Oeps iets ging verkeerd. Probeer later opnieuw";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel = "stylesheet" href="./View/css/project_styles.css"/>
    <title>Forum Alfa-college</title>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        form{ width: 350px; padding: 20px; }
    </style>
   </head>
  <body>
  	<h1>Forum Alfa-college</h1>
  	<nav>
      <button class="btn btn-default"><a href="login.php">Inloggen</a></button>
      <button class="btn btn-default"><a href="register.php">Registreer</a></button>
      <button class="btn btn-default"><a href="#">Creër een onderwerp</a></button>
      <button class="btn btn-default"><a href="#">Creër een categorie</a></button>
      <button class="btn btn-default"><a href="logout.php">Uitloggen</a></button>
  	</nav>
  	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
          <label>Gebruikernaam</label>
          <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
          <span class="help-block"><?php echo $username_err; ?></span>
        </div>    
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
           <label>Wachtwoord</label>
           <input type="password" name="password" class="form-control">
           <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Geen account? <a href="register.php">Registeer hier</a>.</p>
      </form>

  </body>
</html>
