<?php
    $hostname = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "assignment1";

    $conn = mysqli_connect($hostname, $username,$password,$dbname);
            //$link = mysqli_connect("aa4xf37s2fw51e.cs0uliqvpua0.us-east-1.rds.amazonaws.com","uts","internet","uts");
    if (!$conn)
        die("Could not connect to Server");
?>