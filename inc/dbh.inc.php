<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "integratedproject";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Cannot connect to server, Reason: " . mysqli_connect_error());
}
