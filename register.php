<?php
define('Myheader', TRUE);
define('Myfooter', TRUE);
include_once 'header.php';

// Include config file
require_once 'inc/config.php';
require_once 'inc/register.inc.php';
require_once 'inc/functions.inc.php';

// Define variables and initialize with empty values
$username = $password = $confirmpwd = $email = $image = "";
$username_err = $password_err = $confirmpwd_err = $email_err = $image_err = "";
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(test_input($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', test_input($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT username FROM user WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = test_input($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = test_input($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
		  }
		  mysqli_stmt_close($stmt);
		  
        }
    
    $validation = empty($image_err);




   





    // Validate email
    if(empty(test_input($_POST["email"]))){
        $email_err = "Please enter a email.";
    } elseif(!filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL)){
        $email_err = "email invaild.";
    } else{
        // Prepare a select statement
        $sql = "SELECT email FROM user WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = test_input($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = test_input($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    /* // Validate password
    if(empty(test_input($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(test_input($_POST["password"])) < 2){//要改翻6
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = test_input($_POST["password"]);
    }
    
    // Validate confirm password
        $confirmpwd_err = "Please confirm password.";     
    } else{
        $confirmpwd = test_input($_POST["confirmpwd"]);
        if(empty($password_err) && ($password != $confirmpwd)){
            $confirmpwd_err = "Password did not match.";
        }
    } */

    $uppercase = preg_match('@[A-Z]@', test_input($_POST["password"]));
    $lowercase = preg_match('@[a-z]@', test_input($_POST["password"]));
    $number    = preg_match('@[0-9]@', test_input($_POST["password"]));
    $specialChars = preg_match('@[^\w]@', test_input($_POST["password"]));

    // Validate password
    if(empty(test_input($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(test_input($_POST["password"])) < 2){//要改翻8
        $password_err = "Password must have atleast 8 characters.";
	} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', test_input($_POST["password"]))){
        $password_err = "Password must be more than 8 characters and must contain numbers, uppercase and lowercase letters and special characters";
    } else{
        $password = test_input($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(test_input($_POST["confirmpwd"]))){
        $confirmpwd_err = "Please confirm password.";     
    } else{
        $confirmpwd = test_input($_POST["confirmpwd"]);
        if(empty($password_err) && ($password != $confirmpwd)){
            $confirmpwd_err = "Password did not match.";
        }
    }











    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirmpwd_err) && empty($email_err) && empty($image_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (username, password, email, profile_image) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            $param_image = $_FILES["uploadImage"];
            $image_name = upload_img($param_image);
			
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_email, $image_name);
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        
    }
    
    // Close connection
    mysqli_close($link);

}
?>



<body style="background-color: rgb(32, 34, 37);">

<div class="parallax-2">

    <section class="signupform">
            <h2>Signup</h2>                
            <div>

            </div>
           
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                
                <div class="signup-item">
                    <label for="username">Username </label>
                    <input type="username" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username">
                </div>
            
                <div class="signup-item">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>"  placeholder="Email">
                    
                </div>

                <div class="signup-item">
                    <label for="password">Password <br></label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password">
                </div>

                <div class="signup-item">
                    <label for="confirmpwd">Confirm password </label>
                    <input type="password" name="confirmpwd" class="form-control" value="<?php echo $confirmpwd; ?>" placeholder="Confirm password">
                </div>
                
                <div class="signup-item">
                    <label for="profileimg">Please upload you profile image </label>
                    <input 
                        type="file" name="uploadImage" id="uploadImage" accept="image/jpg, image/jpeg, image/png"
                        class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>"
                    >
                    <div>UpProfileImageimage/jpg, image/jpeg, image/png*Upload file is image type only</div>

                </div>
                <div  class="signup-item">
                    
                    <div class="g-recaptcha" data-sitekey="6LcjnHYfAAAAAAfCp_b518ZzuFQz11qkNLZ8EcC5" ></div>
                    <br>
                </div>
                

                <div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                
            </form>

        <?php
        if(!empty($username_err)){
            echo $username_err . "<br>";
        }
        if(!empty($email_err)){
            echo $email_err . "<br>";
        }
        if(!empty($password_err)){
            echo $password_err . "<br>";
        }
        if(!empty($confirmpwd_err)){
            echo $confirmpwd_err . "<br>";
        }

    ?>
    </section>
    </div>

    </body>
    
<?php
 include_once 'footer.php';
?>
