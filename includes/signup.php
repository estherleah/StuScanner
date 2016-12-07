<?php
session_start();
include '../db/dbh.php';

$email = $_POST['email'];
$uid = $_POST['uid'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
$admin = $_POST['admin'];

if ($pwd !== $pwd2) {
    header("Location: ../index.php?error=notsame");
    exit();
	}
if (empty($email)){
    header("Location: ../index.php?error=emailempty");
    exit();
}
if (empty($uid)){
    header("Location: ../index.php?error=usernameempty");
    exit();
}
if (empty($pwd)){
    header("Location: ../index.php?error=passwordempty");
    exit();
}
else {

    $sql = "SELECT uid FROM users WHERE uid='$uid'";
    $result = mysqli_query($conn, $sql);
    $uidcheck = mysqli_num_rows($result);
    
	if($uidcheck > 0){
        header("Location: ../index.php?error=username");
        exit();

    }else{
        $sql = "INSERT INTO users (email, uid, pwd) VALUES ('$email', '$uid', '$pwd')";

        $result = mysqli_query($conn, $sql);

        header("Location: ../index.php");
    }
}

?>
