<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
    $hostname = "localhost";
    $username = "catherine";
    $password = "password1";
    $dbname = "assignment1";

    $conn = mysqli_connect($hostname, $username, $password, $dbname);
            //$link = mysqli_connect("aa4xf37s2fw51e.cs0uliqvpua0.us-east-1.rds.amazonaws.com","uts","internet","uts");
    if (!$conn)
        die("Could not connect to Server");
?>