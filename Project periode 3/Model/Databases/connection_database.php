<?php
session_start();
include('Controller/project_functions.php');
$DATABASE_HOST = "localhost";
$DATABASE_USER = "root";
$DATABASE_PASS = "";
$DATABASE_NAME = "project_database";
$email = $_POST['email'];
$wachtwoord = $_POST['wachtwoord'];


try {
    $conn = new PDO("mysql:host=" . $DATABASE_HOST . ":dbname=" . $DATABASE_NAME, $DATABASE_USER, $DATABASE_PASS);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
