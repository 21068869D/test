<?php
include_once 'header.php';
?>

<div class="wrapper">
<div class="parallax-1">
    <section>
        <?php
        if(isset($_SESSION["useruid"])){
            $uid = $_SESSION["useruid"];
            $sql = "SELECT * FROM image where userUid = '$uid'";
            $query = mysqli_query($conn, $sql);
            echo "<h1>Welcome to owner page, ".$uid."</h1><br>";
            echo " <div class='text-center'><a href='create.php'>+ Sell an NFT </a><br><br>Your NFTs</div><div class='space'></div>";
        }?>
        <scetion class="card-c"> <!--  Bernard: For flex container -->
            <?php foreach($query as $q){?>
                <div class="card-image">

                <!-- Bernard: can try this, styling added-->
                    <div class="card-image" style="background-image: url('<?php echo $q['path']?>');"></div> 

                    <h2><?php echo $q['title'] ?></h2>
                    <p><br><?php echo "<img src=\"",$q['path'],"\""?></p> 
                    <a href="nftdetail.php?id=<?php echo $q['Id'] ?>"> View</a>
                </div><?php } ?>
            </section>
        </div>
        
    </section>
    <div class="space"></div>    
</div>
</div>
</body>

</html>