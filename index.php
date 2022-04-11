<?php
include_once 'header.php';


$sql = "SELECT image FROM user WHERE username = ?";

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_username);

    // Set parameters
    $param_username = $_SESSION["username"];

    mysqli_stmt_execute($stmt);

    //Getting the result
    $res = mysqli_stmt_get_result($stmt);

    $image = mysqli_fetch_row($res);

    // Close statement
    mysqli_stmt_close($stmt);
}











?>
<div class="img1"></div>

<div style="height:1000px;background-color:blue;font-size:36px">
In this website,you can buy or sell the NFT art. 
</div>

<div class="img2"></div>

<div style="height:1000px;background-color:yellow;font-size:36px">
You can using any payment method for buy and sell the NFT art.
</div>

<div class="img3"></div>

<div style="height:50px;background-color:grey;font-size:36px">
<a href='login.php'>Click here to login the system.</a>
</div>


<?php
include_once 'footer.php';
?>
