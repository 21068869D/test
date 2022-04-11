<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

function upload_img($profile_image){
    /*
	$email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["password"];
    $repeatpwd = $_POST["confirmpwd"]; */
    
	//print_r($profile_image["tmp_name"]);
    $profileImageName = time().'-'.$profile_image["name"];
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/test/upload/";
    $move_file = $_SERVER['DOCUMENT_ROOT']."/test/upload/" . basename($profileImageName);
    //$target_file = $target_dir . basename($profileImageName);
	//echo($_SERVER['DOCUMENT_ROOT']."/upload");
    //print("<br/>".$move_file);
	if(is_writable($target_dir){
		move_uploaded_file($profile_image["tmp_name"],$move_file);
		return $profile_image;
	}else{
	return "The directory cannot write.";}
}

/*
	$email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["password"];
    $repeatpwd = $_POST["confirmpwd"]; 
    if(pwdMatch($pwd, $repeatpwd)!==false){
        header("location: ../signup.php?error=passwordmismatch");
        exit();
    }
    if(uidExists($conn, $username)!==false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    createUser($conn,$email,$username,$pwd,$target_file);
}

else{
    header("location: ../signup.php");
    exit();
}

*/
?>
