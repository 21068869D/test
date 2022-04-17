<?php
define('Myheader', TRUE);
define('Myfooter', TRUE);
include_once 'header.php';


echo "<div class='parallax-4'>";
 
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
            
        }
        ?>

    </div>

<?php
include_once 'footer.php';
?>