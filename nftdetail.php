<?php
include_once 'header.php';

echo "<div class='parallax-4'>";

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "SELECT * FROM image where Id = '$id'";
    $query = mysqli_query($conn, $sql);
    $_SESSION['imageid'] = $id;
    foreach($query as $q){?>
    <div class="titlebox">
        <h1><?php echo $q['title'] ?></h1>
        <p><br>Salary: <?php echo $q['price']?>
        <p><br><?php echo "<img src=\"",$q['path'],"\""?></p>
        

        <button class="btn-primary"><a href="delete.php">Delete</a></button>
        <?php  }} ?>

        </div>

    </div>

<?php
include_once 'footer.php';
?>