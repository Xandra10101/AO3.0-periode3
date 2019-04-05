<?php
    include('Controller/project_functions.php');
$pag_get = get_pag();
$pag_post = post_pag();
if($pag_post == "register"){
  include("Model/Databases/connection_database.php");
}
if($pag_get == "register"){
    include("View/register.php");
}else{
    include("View/inlog.php");
}

include('View/signup.php');


?>


<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href="View/css/project_styles.css"/>
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
  </body>
</html> -->
