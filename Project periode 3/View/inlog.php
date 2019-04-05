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
  	<form method="post" action="index.php">
  		<fieldset>
  			<legend>Login</legend>
  			<input required="text" id="username" placeholder="Username">
  			<input type="password" id="password" placeholder="Password">
  			<input type="submit" name="send" id="send" value="Log in">
  		</fieldset>

  	</form>

  </body>
</html>
