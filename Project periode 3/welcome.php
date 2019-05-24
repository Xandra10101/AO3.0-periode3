<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: inlog.php");
	exit;
}

?>
<!DOCTYPE html>
<html lang="eng">
<head>
	<meta charset="UTF-8">
	<title>Forum AO3.0</title>
	<link rel = "stylesheet" href="/View/css/project_styles.css"/>
</head>
<body>
<h1>Hoi <b><?php echo htmlspecialchars($SESSION["username"]); ?></b>. Welkom op het forum</h1>
	<a href="#">Creër een onderwerp</a>
    <a href="#">Creër een categorie</a>
    <a href="#">Uitloggen</a>

</body>
</html>
