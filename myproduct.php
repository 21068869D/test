<?php
include_once 'header.php';
require_once 'inc/functions.inc.php';
?>

<div class="wrapper">
<div class="parallax-1">
    <section>
        <?php
        if(isset($_SESSION["username"])){

            $sql = "SELECT * FROM nftimage where owner = ?;";
            
            $uid =$_SESSION["username"];
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $uid);

                // Set parameters
                

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    //print_r($_SESSION["username"]);
                    $query=$stmt->get_result();
                    echo "<h1 style='color: blue;'>Welcome to owner page, ".$uid."</h1><br>";
                    echo " <div class='text-center'><a href='createNFT.php'>+ Sell an NFT </a><br><br>Your NFTs</div><div class='space'></div>";
                    ?>
                    <?php foreach($query as $q){?>
                    
                            <div class="card-image">

                            <!-- Bernard: can try this, styling added-->
                                <div class="card-image" style="background-image: url('<?php ?>');"></div> 

                                <h2><?php echo $q['title']; ?></h2>
                                <p><br>
                                <?php echo "<img src=\"". $q['image']. "\">";?>
                                </p> 
                                <?php echo "<a href='nftdetail.php'> View</a>" ; ?>
                            </div><?php } ?><?php
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
            }
            

            

            
            
            //$query = mysqli_query($link, $sql);
            echo "<h1>Welcome to owner page, ".$uid."</h1><br>";
            echo " <div class='text-center'><a href='create.php'>+ Sell an NFT </a><br><br>Your NFTs</div><div class='space'></div>";
        }?>
        <scetion class="card-c"> <!--  Bernard: For flex container -->
            <?php foreach($query as $q){?>
                <div class="card-image">

                <!-- Bernard: can try this, styling added-->
                    <div class="card-image" style="background-image: url('<?php echo $q['image']?>');"></div> 

                    <h2><?php echo $q['title'] ?></h2>
                    <p><br><?php echo "<img src=\"",$q['image'],"\""?></p> 
                    <a href="nftdetail.php?id=<?php echo $q['Id'] ?>"> View</a>
                </div><?php } ?>
            </section>
        </div>
        
    </section>
    <div class="space"></div>    
</div>
</div>

<?php
include_once 'footer.php';
?>