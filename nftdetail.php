<?php
define('Myheader', TRUE);
define('Myfooter', TRUE);
include_once 'header.php';


echo "<div class='parallax-4'>";

/*if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "SELECT * FROM image where Id = '" . $id . "';";
    $query = mysqli_query($conn, $sql);
    $_SESSION['imageid'] = $id;
    foreach($query as $q){?>
    <div class="titlebox">
        <h1><?php echo $q['title'] ?></h1>
        <p><br>Salary: <?php echo $q['price']?>
        <p><br><?php echo "<img src=\"",$q['path'],"\""?></p>
        

        <button class="btn-primary"><a href="delete.php">Delete</a></button>
        <?php  }}

        </div>*/ 
        if(isset($_SESSION["username"])){

            $sql = "SELECT * FROM nftimage where nftid = ?;";
            
            $imageid = $_GET["id"];
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $imageid);

                // Set parameters
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    //print_r($_SESSION["username"]);
                    $query=$stmt->get_result();
                    ?>
                    <scetion class="card-c">
                    <?php foreach($query as $q){?>
                            <div class="detailnft">
                            <!-- Bernard: can try this, styling added-->
                                <div class="detailnft-image" style="background-image: url('<?php  echo $q['image']?>');"></div> 
                                <h2>Title: <?php echo $q['title']; ?></h2>
                                <h2>Price: <img src="assets\ETH.svg" alt="ETH image"><?php echo $q['price']; ?></h2>
                                <?php echo "<a href='payment.php?id=".$q['nftid']."'>Buy</a>" ;?>
                            </div>
                    <?php } ?>
                    </section>
                    <?php
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            /*$query = mysqli_query($link, $sql);
            echo "<h1>Welcome to owner page, ".$uid."</h1><br>";
            echo " <div class='text-center'><a href='create.php'>+ Sell an NFT </a><br><br>Your NFTs</div><div class='space'></div>";*/
        }
        ?>

    </div>

<?php
include_once 'footer.php';
?>