<?php
define('Myheader', TRUE);
define('Myfooter', TRUE);
include_once 'header.php';
require_once 'inc/functions.inc.php';

$password_err = $password = "";
if (!isset($_SESSION["loggedin"]) || ($_SESSION["loggedin"] !== true)) {
    header("location: login.php");
    exit;
}
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Check if password is empty
    if(empty(test_input($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = test_input($_POST["password"]);
    }
  
    // Validate credentials
    if(empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password,ETH FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $username);
            
            // Set parameters
            $username = $_SESSION["username"];
        
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
            
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){ 
                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $ETH);
                   
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            mysqli_stmt_close($stmt);
                            
                            // Prepare a select statement
                            $sql = "SELECT owner, price FROM nftimage WHERE nftid = ?;";//now is find the owner of the nft, need to change the owner of the image
                           
                            if($stmt = mysqli_prepare($link, $sql)){
                                mysqli_stmt_bind_param($stmt, "d", $_POST["nftid"]);

                                // Attempt to execute the prepared statement
                                if(mysqli_stmt_execute($stmt)){
                                    
                                    // Store result
                                    $query=$stmt->get_result();
                                    foreach($query as $a){
                                        $seller = $a['owner'];
                                        $price = $a['price'];
                                        
                                    }

                                    mysqli_stmt_close($stmt);
                                    $sql = "SELECT username,ETH FROM user WHERE username = ?";
                                    $stmt = mysqli_prepare($link, $sql);
                                    mysqli_stmt_bind_param($stmt, "s", $seller);
                                    mysqli_stmt_execute($stmt);
                                    $query=$stmt->get_result();
                                    
                                    foreach($query as $a){$seller_eth = $a['ETH'];}

                                    if ( $ETH > $price ){    //check the eth > price or not
                                        
                                        print("eth>price");

                                        mysqli_stmt_close($stmt);
                                        $seller_balance = $seller_eth + $price;//old ower receive eth
                                        $sql3 = "update user set ETH = ? where username = ?;"; //change the eth of the user

                                        if($stmt3 = mysqli_prepare($link, $sql3)){
                                            mysqli_stmt_bind_param($stmt3, "ds", $seller_balance, $seller);
                                            mysqli_stmt_execute($stmt3);
                                            mysqli_stmt_close($stmt3);

                                            $balance =  $ETH - $price;  //new ower send eth

                                            $sql2 = "update user set ETH = ? where username = ?;"; //change the eth of the user
                                            
                                            if($stmt2 = mysqli_prepare($link, $sql2)){
                                                mysqli_stmt_bind_param($stmt2, "ds", $balance, $username);
                                                mysqli_stmt_execute($stmt2);
                                                 mysqli_stmt_close($stmt2); 

                                                $sql = "update nftimage set owner = ? where nftid = ?;";//change the owner of the image
                                                if($stmt=mysqli_prepare($link, $sql)){
                                                    mysqli_stmt_bind_param($stmt, "sd", $username, $_POST["nftid"]);
                                                    mysqli_stmt_execute($stmt);
                                                    mysqli_stmt_close($stmt);

                                                    echo "password match! owner changed";
                                                }else{
                                                    echo ("Oops! Something went wrong. Please try again later.");
                                                }
                                                
                                        }else{
                                            echo ("Oops! Something went wrong. Please try again later.");
                                            }
                                        }else{
                                            echo ("Oops! Something went wrong. Please try again later.");
                                            }
                                    }else{
                                        echo "You have not enough money";
                                        }
                                

                                } else{
                                    echo "Oops! Something went wrong. Please try again later.";
                                }
                                
                                
                            }
                            
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                    print ("logined?");
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            //Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}else{echo "no posting";}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $form_id=$_POST["nftid"];
    print("formid=".$form_id);
}
elseif($_SERVER["REQUEST_METHOD"] == "GET"){
    $form_id=$_GET["id"];
    print("formid=".$form_id);
}
?>

<div class="wrapper">
<div class="parallax-1">
    <section>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
            <div class="login-item">
                <input type="password" name="password" class="form-control"  placeholder="Password">
                <span class="invalid-feedback"><?php echo $password_err ?></span>
                <input type="hidden" name='nftid' value='<?php echo $form_id;?>'></input>
            </div>

            <div class="login-item">
                <input type="submit" class="login-btn" value="Confirm">
            </div>

            
        </form>

<?php
include_once 'footer.php';
?>

