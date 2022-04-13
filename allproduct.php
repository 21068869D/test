<?php 
include_once 'header.php';
require_once 'inc/functions.inc.php';
?>
<div class="wrapper">
<div class="parallax-1">
    <section>
        <?php
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
                    
                    echo "<h1 style='color: white; text-align: center;'>All NFT are here </h1><br>";
                    //echo " <div class='text-center'><a href='createNFT.php'>+ Sell an NFT </a><br><br>Your NFTs</div><div class='space'></div>";
                    ?>
                    <scetion class="card-c">
                    <?php foreach($query as $q){?>
                            <div class="card">
                            <!-- Bernard: can try this, styling added-->
                                <div class="card-image" style="background-image: url('<?php  echo $q['image']?>');"></div> 
                                <h2 style='text-align: center;'><?php echo $q['title']; ?></h2>
                                <p style=' text-align: center;'>by <span style="color:blue; font-weight: bold;"><?php echo $q['owner']; ?></span></p>
                                <?php echo "<a href='nftdetail.php?id=".$q['nftid']."'>View</a>";?>
                            </div>
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
include 'footer.php';
?>