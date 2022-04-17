<?php
define('Myheader', TRUE);
define('Myfooter', TRUE);
include_once 'header.php';

// Include config file
require_once 'inc/config.php';
require_once 'inc/create.inc.php';
require_once 'inc/functions.inc.php';

// Define variables and initialize with empty values
$imagetitle = $price = $verify = $hash_image = "";


$imagetitle_err = $price_err = $image_err = "";
if (!isset($_SESSION["loggedin"]) || ($_SESSION["loggedin"] !== true)) {
    header("location: login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $success = "";
}
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate imagetitle
    if (empty(test_input($_POST["imagetitle"]))) {
        $imagetitle_err = "Please enter the NFT title.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', test_input($_POST["imagetitle"]))) {
        $imagetitle_err = "NFT title can only contain letters, numbers, and underscores.";
    } else {
        $imagetitle = test_input($_POST["imagetitle"]);
    }

    // Validate price
    if (empty(test_input($_POST["price"]))) {
        $price_err = "Please enter the Price of the NFT.";
    } elseif (!is_numeric(test_input($_POST["price"]))) {
        $imagetitle_err = "Price can only contain numbers.";
    } else {
        $price = test_input($_POST["price"]);
    }
    // Validate image
    if (empty($_FILES["nftimage"])) {
        $image_err = "Please enter the image of the NFT.";
    } else {
        //Prepare a hash value
        $image_name = "";

        $param_image = $_FILES["nftimage"];


        $verify = hash_file("sha256", $_FILES["nftimage"]['tmp_name']); //hash function

        // Prepare a select statement
        $sql = "SELECT hash_image FROM nftimage WHERE hash_image = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_hash_image);

            // Set parameters
            $param_hash_image = $verify;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $image_err = "This NFT is already taken.";
                } else {
                    $hash_image = $verify;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }

    // Check input errors before inserting in database
    if (empty($imagetitle_err) && empty($price_err) && empty($image_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO nftimage (hash_image, owner, price, image, title) VALUES (?,?,?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters


            // Set parameters
            $param_hash_image = $verify;
            $param_owner = $_SESSION["username"];
            $param_price = $price;
            $param_image = $_FILES["nftimage"];
            $image_name = upload_img($param_image);
            $param_imagetitle = $imagetitle;


            mysqli_stmt_bind_param($stmt, "sssss", $param_hash_image, $param_owner, $param_price, $image_name, $param_imagetitle);
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to createNFT page
                $success = "The upload success.";
                header("location: createNFT.php");
            } else {
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


<div class="parallax-2">

    <section class="imageform">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<h2>" . $success . "</h2>";
        }
        ?>
        <h2>Post new NFT</h2>
        <div>

        </div>
        <form action="createNFT.php" method="post" enctype="multipart/form-data">
            <div class="image-item">
                <label for="imagetitle">NFT title: </label>
                <input type="text" name="imagetitle" placeholder="NFT title" class="form-control" required>
            </div>
            <div class="image-item">
                <label for="price">Price: </label>
                <input type="text" name="price" placeholder="Price" class="form-control" required>
            </div>
            <div class="image-item">
                <label for="nftimage">Please upload the NFT image:</label>
                <input type="file" name="nftimage" accept="image/jpg, image/jpeg, image/png" class="form-control" required>
                <div>UpProfileImageimage/jpg, image/jpeg, image/png*Upload file is image type only</div>
            </div>
            <?php if (isset($_SESSION["username"])) {
                echo "<input type='hidden' name='username' value='" . $_SESSION["username"] . "'>";
            } ?>
            <div>
                <input type="submit" name="create" class="btn btn-primary" value="create">
                <input type="reset" name="reset" class="btn btn-secondary ml-2" value="reset">
            </div>
        </form>
        <?php
        if (!empty($imagetitle_err)) {
            echo $imagetitle_err . "<br>";
        }
        if (!empty($price_err)) {
            echo $price_err . "<br>";
        }
        if (!empty($image_err)) {
            echo $image_err . "<br>";
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $success = "";
        }
        ?>

        </secion>
</div>

<?php
include_once 'footer.php';
?>