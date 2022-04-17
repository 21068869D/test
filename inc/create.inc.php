
<?php
require_once 'config.php';

function upload_temp_img($nft_image){
    
    $nftImageName = $nft_image["name"];
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/temp/";   //The path only for alex
    $move_file = $_SERVER['DOCUMENT_ROOT']."/temp/" . basename($nftImageName); //The path only for alex
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
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/nft/";   //The path only for alex
    $move_file = $_SERVER['DOCUMENT_ROOT']."/nft/" . basename($nftImageName); //The path only for alex
    $target_file2 = "nft/".basename($nftImageName);

	if(is_writable($target_dir)){
		move_uploaded_file($nft_image["tmp_name"],$move_file);
		return $target_file2;
	}else
    {
        return "$move_file";
    }
}

?>
