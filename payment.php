<?php
include_once 'header.php';
require_once 'inc/functions.inc.php';

//echo $_SESSION['username'];
$password_err = $password = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Check if password is empty
    if(empty(test_input($_POST["password"]))){
        
        $password_err = "Please enter your password.";
    } else{
        $password = test_input($_POST["password"]);
    }
    //print("test101");
    // Validate credentials
    if(empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password,ETH FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $username);
            //print("test202");
            // Set parameters
            $username = $_SESSION["username"];
        
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
            
                // Store result
                mysqli_stmt_store_result($stmt);

                //print("303");
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){ 
                    //print("test123");
                    //print_r($stmt);
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $ETH);
                   
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            // Close statement
                            //$eth=$ETH;
                            //print("test for eth <br/>");
                            //print($eth);
                            //print($ETH);
                            mysqli_stmt_close($stmt);
                            
                            //print("test2");
                            // Prepare a select statement
                            $sql = "SELECT owner, price FROM nftimage WHERE nftid = ?;";//now is find the owner of the nft, need to change the owner of the image
                            //print("test3");
                            if($stmt = mysqli_prepare($link, $sql)){
                                mysqli_stmt_bind_param($stmt, "d", $_POST["nftid"]);

                                // Attempt to execute the prepared statement
                                if(mysqli_stmt_execute($stmt)){
                                    //print_r($_SESSION["username"]);
                                    // Store result
                                    $query=$stmt->get_result();
                                    foreach($query as $a){
                                        $seller = $a['owner'];
                                        $price = $a['price'];
                                        
                                    }

                                    
                                    //mysqli_stmt_bind_result($stmt, $owner, $price);
                                    //$query=$stmt->get_result();
                                    
                                    //foreach($stmt as $q){
                                       //$seller=$a['owner'];
                                       //$price=$a['price'];
                                    //print("test");
                                    //print($ETH);
                                    mysqli_stmt_close($stmt);
                                    $sql = "SELECT username,ETH FROM user WHERE username = ?";
                                    $stmt = mysqli_prepare($link, $sql);
                                    mysqli_stmt_bind_param($stmt, "s", $seller);
                                    mysqli_stmt_execute($stmt);
                                    $query=$stmt->get_result();
                                    
                                    foreach($query as $a){$seller_eth = $a['ETH'];}

                                    if ( $ETH > $price ){    //check the eth > price or not
                                        //$sql = "UPDATE user SET balance = balance – ” . $_POST[‘amt’] . ” WHERE id = ” . $_POST[‘from’]).";
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
                            //SELECT id,username, ETH FROM  user WHERE username = ?
                            

                            //SELECT id, username, ETH FROM user WHERE username = ?
                            //update id, username, ETH FROM user WHERE username = ?
                            
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

            // Close statement
            //mysqli_stmt_close($stmt);
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
        /*
        if(isset($_SESSION["username"])){

            $sql = "SELECT * FROM `nftimage` WHERE owner != ?;";
            
            $uid =$_SESSION["username"];
            if($stmt = mysqli_prepare($link, $sql)){

                // Set parameters
                mysqli_stmt_bind_param($stmt, "s", $uid);

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    //print_r($_SESSION["username"]);
                    $query=$stmt->get_result();
                    
                    echo "<h1 style='color: white; text-align: center;'>Please input password to comfirm payment</h1><br>";
                    //echo " <div class='text-center'><a href='createNFT.php'>+ Sell an NFT </a><br><br>Your NFTs</div><div class='space'></div>";
                    ?>
                    <scetion class="card-c">
                    <?php foreach($query as $q){?>
                            
                    <?php } ?>
                    </section>
                    <?php
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
        }?>
    </section>
    </div>
</div>


<?php
/*
                // connect to database
                $dbh = mysqli_connect(“localhost”, “user”, “pass”, “test”) or die(“Cannot connect”);

                // turn off auto-commit
                mysqli_autocommit($dbh, FALSE);

                // look for a transfer
                if ($_POST[‘submit’] && is_numeric($_POST[‘amt’])) {
                    // add $$ to target account
                    $result = mysqli_query($dbh, “UPDATE accounts SET balance = balance + ” . $_POST[‘amt’] . ” WHERE id = ” . $_POST[‘to’]);
                    if ($result !== TRUE) {
                        mysqli_rollback($dbh);  // if error, roll back transaction
                    }
                
                    // subtract $$ from source account
                    $result = mysqli_query($dbh, “UPDATE accounts SET balance = balance – ” . $_POST[‘amt’] . ” WHERE id = ” . $_POST[‘from’]);
                    if ($result !== TRUE) {
                        mysqli_rollback($dbh);  // if error, roll back transaction
                    }

                    // assuming no errors, commit transaction
                    mysqli_commit($dbh);
                }

                // get account balances
                // save in array, use to generate form
                $result = mysqli_query($dbh, “SELECT * FROM accounts”);
                while ($row = mysqli_fetch_assoc($result)) {
                    $accounts[] = $row;
                }

                // close connection
                mysqli_close($dbh);
?>
    */


 /*   if ( $eth>$price ){    //check the eth > price or not
        //$sql = "UPDATE user SET balance = balance – ” . $_POST[‘amt’] . ” WHERE id = ” . $_POST[‘from’]).";
        
        $sql = "update nftimage set owner = ? where nftid = ?;";//change the owner of the image
        mysqli_stmt_bind_param($stmt, "ss", $uid, $_GET["id"]);
        
        if($stmt = mysqli_prepare($link, $sql)){
            $balance =  $eth - $price;  //new ower send eth
            $sql = "update user set ETH = ? where username == ?;"; //change the eth of the user
            mysqli_stmt_bind_param($stmt, "ds", $balance,$uid);
            if($stmt = mysqli_prepare($link, $sql)){
                $balance = $seller_eth + $price;   //old ower receive eth
                $sql = "update user set ETH = ? where username == ?;"; //change the eth of the user
                mysqli_stmt_bind_param($stmt, "ds", $balance,$seller);
                }
        }else{
            echo ("Oops! Something went wrong. Please try again later.");
            }
    }else{
        echo "You have not enough money";
        }

*/ 

include_once 'footer.php';
?>

