<?php 
	

$dbServername = "localhost"; // what is your server name
$dbUsername = "root"; // root because using local server
$dbPassword = ""; // xampp doesn't have password as default
$dbName = "loginsystem"; // name of db in my phpmyadmin

// connect to server
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);