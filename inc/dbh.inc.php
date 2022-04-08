<?php
require_once (./config.php);


try {
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
}catch{
    die("Cannot connect to server, Reason: " . mysqli_connect_error());
}

?>
