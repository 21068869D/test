<?php  //half
/*
if(isset($_POST["create"])){
    $imagetitle = $_POST["imagetitle"];
    $price = $_POST["price"];
    $useruid = $_POST["username"];
    
    $imageName = time() . '-' . $_FILES["image"]["name"];
    $tmpdir = "../temp/";
    $target_dir = "./upload/";
    $move_file = "../upload/";
    $tmp_file = $tmpdir.basename($imageName);
    $target_file = $target_dir . basename($imageName);
    $actual_file = $move_file . basename($imageName);
    
    
    move_uploaded_file($_FILES["image"]["tmp_name"], $tmp_file);
    $verify = hash_file('sha256', $tmp_file);
    

    require_once 'config.php';
    require_once 'functions.inc.php';


    if(fileExists($link, $verify)!==false){
        header("location: ../create.php?error=fileexists");//change?
        unlink($tmp_file);
        exit();
    }
    createNFTRecorc($link,$verify,$imagetitle,$useruid,$price,$target_file);
    move_uploaded_file($_FILES["image"]["tmp_name"], $actual_file);
    unlink($tmp_file);
}
else{
    header("location: ../create.php");
    exit();
}*/
?>

<?php
require_once 'config.php';

function upload_temp_img($nft_image){
    
    $nftImageName = $nft_image["name"];
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/3334gpproject/test/temp/";   //The path only for alex
    $move_file = $_SERVER['DOCUMENT_ROOT']."/3334gpproject/test/temp/" . basename($nftImageName); //The path only for alex
    $target_file2 = "temp/".basename($nftImageName);
    
	if(is_writable($target_dir)){
		move_uploaded_file($nft_image["tmp_name"],$move_file);
		return $target_file2;
	}else
    {
        return "The directory cannot write.";
    }
}

function upload_img($nft_image){
    
    $nftImageName = time().'-'.$nft_image["name"];
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/3334gpproject/test/nft/";   //The path only for alex
    $move_file = $_SERVER['DOCUMENT_ROOT']."/3334gpproject/test/nft/" . basename($nftImageName); //The path only for alex
    $target_file2 = "nft/".basename($nftImageName);
	if(is_writable($target_dir)){
		move_uploaded_file($nft_image["tmp_name"],$move_file);
		return $target_file2;
	}else
    {
        return "The directory cannot write.";
    }
}

?>
