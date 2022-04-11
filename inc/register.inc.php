<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';


function upload($profile_image){
if(isset($_POST["submit"])){
    /*$email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["password"];
    $repeatpwd = $_POST["confirmpwd"];*/
    
    $profileImageName = time() . '-' .$profile_image["tmp_name"];
    $target_dir = "../upload/";
    $move_file = "../upload/" . $profileImageName;
    $target_file = $target_dir . basename($profileImageName);
    
    //print_r($_FILES["profile_image"]);
    move_uploaded_file( $profile_image["tmp_name"],$move_file);
    return $move_file;
/*
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
}
}