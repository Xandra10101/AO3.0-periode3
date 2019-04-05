<?php
session_start();
include('Controller/project_functions.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_database";
$email = $_POST['email'];
$wachtwoord = $_POST['wachtwoord'];


try {
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $con->prepare("INSERT INTO users(name email, password, studentnumber, username) VALUES (:name, :email, :password, :studentnumber, :username)");
    $query->bindParam(':name', $name);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->bindParam(':studentnumber', $studentnumber);
    $query->bindParam(':username', $username);
    
    $name;
    $email;
    $password;
    $studentnumber;
    $username;
    
    $query->execute();


    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    }

// $conn = null;

?>