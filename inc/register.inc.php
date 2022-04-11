<?php

if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $repeatpwd = $_POST["repeatpwd"];
    
    $profileImageName = time() . '-' . $_FILES["profileimg"]["name"];
    $target_dir = "./uploads/";
    $move_file = "../uploads/" . basename($profileImageName);
    $target_file = $target_dir . basename($profileImageName);
    

    move_uploaded_file($_FILES["profileimg"]["tmp_name"], $move_file);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

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

