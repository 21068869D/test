<?php
require_once ('./config.php');

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Cannot connect to server, Reason: " . mysqli_connect_error());
}


/*try {
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
}catch(){
    die("Cannot connect to server, Reason: " . mysqli_connect_error());
}
^@rexluk Didnt work so I comment them for now - Bernard
*/



?>
