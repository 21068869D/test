<?php//half

if(isset($_POST["create"])){
    $imagetitle = $_POST["imagetitle"];
    $price = $_POST["price"];
    $useruid = $_POST["useruid"];
    
    $imageName = time() . '-' . $_FILES["image"]["name"];
    $tmpdir = "../temp/";
    $target_dir = "./uploads/";
    $move_file = "../uploads/";
    $tmp_file = $tmpdir.basename($imageName);
    $target_file = $target_dir . basename($imageName);
    
    
    move_uploaded_file($_FILES["image"]["tmp_name"], $tmp_file);
    $verify = hash_file('sha256', $tmp_file);
    

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';


    if(fileExists($conn, $verify)!==false){
        header("location: ../signup.php?error=usernametaken");//change?
        exit();
    }
    createNFTRecorc($conn,$verify,$imagetitle,$useruid,$price,$target_file);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
}
else{
    header("location: ../create.php");
    exit();
}