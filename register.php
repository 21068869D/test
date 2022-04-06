<?php
include_once 'header.php';
?>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>



<body style="background-color: rgb(32, 34, 37);">

<div class="parallax-2">

    <section class="signupform">
            <h2>Signup</h2>                
            <div>

            </div>
           
            <form action="inc/signup.inc.php" method="post" enctype="multipart/form-data">
         
                
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























<!-- <head>
  
    <title> Sign Up</title>

</head> -->


<!-- <body class="is-preload"> -->


    <!-- Heading -->
    <!-- <div id="heading">
        <h1>Sign Up</h1>
    </div> -->

    <!-- Main -->
    <!-- <section id="main" class="wrapper">
        <div class="inner">
            <div class="content">
 -->
                <!-- Form -->
                <!-- <h3>Personal information</h3>
                <form method="post">
                    <div class="row gtr-uniform">

                        <div class="col-12">
                            <h5>Nick name:</h5>
                            <input type="text" name="nick_name" id="nick_name" />
                            <br>
                            <h5>Email:</h5>
                            <input type="email" name="email" id="email" />
                        </div> -->

                        <!-- Break -->
                        <!-- <div class="col-12">
                            <h3>Location</h3>
                            <select name="Country">
                                <option value="" selected="selected">Select Country</option>
                                <?php $arrayLength = count($LocationArray); $i = 0; while ($i < $arrayLength)
			                    	{
				                        /*echo '<option value="'.$LocationArray[$i].'">'.$LocationArray[$i].'</option>'; $i++;*/
			                    	}
                                ?>
                            </select>
                        </div> -->

                        <!-- Break -->
                        <!-- <div class="col-6 col-12-xsmall">
                            <h3>Password</h3>
                            <input type="password" name="Password" id="password" value="" />
                            <br>
                            <h3>Comform Password </h3>
                            <input type="password" name="Password_Comform" id="Password_Comform" />
                            <br>
                            <input type="checkbox" id="checkbox-beta" name="checkbox" onclick="showPassword()">
                            <label for="checkbox-beta">Show password</label>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

</body>

</html> -->
