<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum Alfa College</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel = "stylesheet" href="./View/css/project_styles.css"/>
</head>
<body>
    <header>
        <h3>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welkom op het Alfa college forum.</h3>
    </header>
    <nav>
    <div class="navi-right">
      <button class="btn btn-info"><a href="#">Creër een onderwerp</a></button>
      <button class="btn btn-info"><a href="#">Creër een categorie</a></button>
      <button class="btn btn-warning"><a href="logout.php">Uitloggen</a></button>
    </div>
    </nav>
    <p>
        
    </p>
</body>
</html>