<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "security_project";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Cannot connect to server, Reason: " . mysqli_connect_error());
}
