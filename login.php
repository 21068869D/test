<?php
include_once 'header.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body  style="background-color: rgb(32, 34, 37);">
        <div class="parallax-3">
            <div class="space"></div>
                <section class="signupform">
                        <h2>Log in</h2>
                        <form action="" method="post">
                            <div class="signup-item">
                                <label for="uid">Username:<br></label>
                                <input type="text" name="uid" placeholder="username" required>
                            </div>
                            <div class="signup-item">
                                <label for="password">Password: <br></label>
                                <input type="password" name="pwd" placeholder="Password" required>
                            </div>
                            <button class="btn-login" type="submit" name="submit">Log in</button>
                        </form>
                        <?php
                            if(isset($_GET["error"])){
                            if($_GET["error"] == "loginfailed"){
                                echo "<p>Incorrect username/password.</p>";
                            }
                        }
                    
                    ?>
                    </section>
            <div class="space"></div>
        </div>

    </body>
</html>