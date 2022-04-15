<?php
require_once 'config.php';

function upload_img($profile_image){
    
    $profileImageName = time().'-'.$profile_image["name"];
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/upload/";   //The path only for alex
    $move_file = $_SERVER['DOCUMENT_ROOT']."/upload/" . basename($profileImageName); //The path only for alex
    $target_file2 = "upload/".basename($profileImageName);
	if(is_writable($target_dir)){
		move_uploaded_file($profile_image["tmp_name"],$move_file);
		return $target_file2;
	}else
    {
        return "The directory cannot write.";
    }
}

?>
