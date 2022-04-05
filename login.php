<?php
include_once 'header.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body style="background-color: rgb(32, 34, 37);">
        <div class="parallax-3">
            <div class="space"></div>
            <section  class="signupform">
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>

                <?php
                /*
                if (!empty($login_err)) {
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }*/
                ?>

                <form action="" method="post">
                    <div class="signup-item">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control ">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="signup-item">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control ">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="signup-item">
                        <div>
                            <input type="checkbox" value="Remember me" name="remember_me_checkbox" />
                            <label for="remember_me_checkbox">Remember Me</label>
                            <br><br>
                        </div>
                        <input type="submit" class="signup-btn" value="Login">
                    </div>

                    <div class="notroboot-item">
                        <div>
                            <?php
                            /*
                                require_once('recaptchalib.php');
                                $publickey = "your_public_key"; // you got this from the signup page
                                echo recaptcha_get_html($publickey);*/
                            ?>



                        
                           
                        </div>
                    </div>

                    <p>Haven’t register yet? <a href="register.php">Register your account</a></p>
                </form>
            </section>
            
        </div>
            
            
        
    </body>
<!--     
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
                       
                    </section>
            <div class="space"></div>
        </div>

    </body> -->
</html>