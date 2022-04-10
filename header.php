<?php
session_start();
include 'inc/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Buy NFTs</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <link rel="stylesheet" href="style.css" type="text/css">


    </head>
    <body style="background-color: rgb(32, 34, 37);">
        <header>
            <div class="container">
                <img src="assets/logo.png" alt="logo" class="logo">
                <nav>
                    <ul>
                        
                        <li><a href='index.php'>Home</a></li>
                        <li><a href="#">Browse</a></li>
                        <li><a href='about.php'>About</a></li>
                        <?php if(isset($_SESSION["useruid"])){?>
                            <li><a href='myproduct.php'>Your NFT</a></li>
                            <li><a href='inc/logout.inc.php'>Logout</a></li>
                        <?php }
                        else{?>
                        <li><a href='login.php'>Login</a></li>
                        <li><a href='register.php'>Signup</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </header>