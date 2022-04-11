<?php
include_once 'header.php';
?>

<body style="background-color: rgb(32, 34, 37);">

<div class="parallax-2">

    <section class="signupform">
            <h2>Signup</h2>                
            <div>

            </div>
           
            <form action="inc/register.inc.php" method="post" enctype="multipart/form-data">
         
                
                <div class="signup-item">
                    <label for="uid">Username </label>
                    <input type="username" name="uid" class="form-control" placeholder="Username" required>
                </div>
            
                <div class="signup-item">
                    <label for="email">E-mail </label>
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                </div>

                <div class="signup-item">
                    <label for="password">Password <br></label>
                    <input type="password" name="pwd" class="form-control" placeholder="Password" required>
                </div>

                <div class="signup-item">
                    <label for="repeatpwd">Confirm password </label>
                    <input type="password" name="repeatpwd" class="form-control" placeholder="Confirm password" required>
                </div>
                
                <div class="signup-item">
                    <label for="image">Please upload a profile image </label>
                    <input type="file" name="profileimg">
                </div>
                <br>
                <div class="g-recaptcha" data-sitekey="6LfADE4fAAAAAMksGMbGSHicRXf-A1CceGM2srtb"></div>
                <br>
                <div>

                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                
            </form>

        <?php
                if(isset($_GET["error"])){
                if($_GET["error"] == "passwordmismatch"){
                    echo "<p>Password mismatch!</p>";
                }
                else if($_GET["error"] == "stmtfailed"){
                    echo "<p>Something went wrong, try again -_-</p>";
                }
                else if($_GET["error"] == "usernametaken"){
                    echo "<p>Username was taken</p>";
                }
                else if($_GET["error"] == "none"){
                    echo "<p>Success, you have signed up!</p>";
                }
            }
        ?>
    </section>
    </div>

    </body>
<?php
 include_once 'footer.php';
?>
