<?php
include_once 'header.php';
?>
<html>

    <body style="background-color: rgb(32, 34, 37);">
        <div class="parallax-3">
            <div class="space"></div>
            <section  class="loginform">
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>

                <?php
                /*
                if (!empty($login_err)) {
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }*/
                ?>

                <form action="" method="post">
                    <div class="login-item">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="login-item">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control"  placeholder="Password">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="login-item">
                        <div>
                            <input type="checkbox" value="Remember me" name="remember_me_checkbox" />
                            <label for="remember_me_checkbox">Remember Me</label>
                            <br><br>
                        </div>
                        <input type="submit" class="login-btn" value="Login">
                    </div>

                    <div class="notroboot-item">
                        <div>
                            <?php
                            /*
                                require_once('recaptchalib.php');
                                $publickey = "your_public_key"; // you got this from the login page
                                echo recaptcha_get_html($publickey);*/
                            ?>



                        
                           
                        </div>
                    </div>

                    <p>Haven’t register yet?<br><a href="register.php">Register your account</a></p>
                </form>
            </section>
            
        </div>
            
<!--     
    <body  style="background-color: rgb(32, 34, 37);">
        <div class="parallax-3">
            <div class="space"></div>
                <section class="loginform">
                        <h2>Log in</h2>
                        <form action="" method="post">
                            <div class="login-item">
                                <label for="uid">Username:<br></label>
                                <input type="text" name="uid" placeholder="username" required>
                            </div>
                            <div class="login-item">
                                <label for="password">Password: <br></label>
                                <input type="password" name="pwd" placeholder="Password" required>
                            </div>
                            <button class="btn-login" type="submit" name="submit">Log in</button>
                        </form>
                       
                    </section>
            <div class="space"></div>
        </div>

    </body> -->
<?php
 include_once 'footer.php';
?>