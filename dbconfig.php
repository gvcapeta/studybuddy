<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "login_3";

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
// error_reporting(E_ALL);


$connection = mysqli_connect($hostname,$username,$password,$dbname);


?>