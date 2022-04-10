
<?php
include_once 'header.php';
?>

<div class="space"></div>
    <section class="imageform">
            <h2>Post new NFT</h2>
           
            <form action="inc/create.inc.php" method="post">
                <div class="image-item">
                    <label for="imagetitle">NFT title: </label>
                    <input type="text" name="imagetitle" placeholder="NFT title" required>
                </div>
                <div class="image-item">
                    <label for="price">Price: </label>
                    <input type="text" name="price" placeholder="Price" required>
                </div>
                <div class="image-item">
                    <label for="image">Please upload NFT image:</label>
                    <input type="file" name="image">
                </div>
                <?php if(isset($_SESSION["useruid"])){
                    echo "<input type='hidden' name='useruid' value='". $_SESSION["useruid"] ."'";} ?>
                
                <button type="reset" name="reset">Reset</button>
                <button type="submit" name="create">Create</button>
            </form>
            <div class="space"></div>

<?php
include_once 'footer.php';
?>