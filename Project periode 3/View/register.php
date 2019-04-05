
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
