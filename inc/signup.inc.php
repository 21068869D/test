<?php

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $email = $_POST["email"];    
    $pwd = $_POST["password"];
    $confirmpwd = $_POST["confirmpwd"];
    
    $profileImageName = time() . '-' . $_FILES["profileimg"]["name"];
    $target_dir = "./uploads/";
    $move_file = "../uploads/" . basename($profileImageName);
    $target_file = $target_dir . basename($profileImageName);
    

    move_uploaded_file($_FILES["profileimg"]["tmp_name"], $move_file);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(pwdMatch($pwd, $confirmpwd)!==false){
        header("location: ../signup.php?error=passwordmismatch");
        exit();
    }
    if(uidExists($conn, $username)!==false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    createUser($conn,$username,$email,$pwd,$target_file);
}
else{
    header("location: ../signup.php");
    exit();
}
